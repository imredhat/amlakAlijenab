<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pages;

class AboutPage extends Controller
{
    /**
     * نمایش فرم ویرایش صفحه درباره ما
     */
    public function edit()
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['about'] = Pages::where('slug', 'about')->first() ?? new Pages();

        return view('admin.pages.about', $data);
    }

    /**
     * ذخیره / به‌روزرسانی اطلاعات صفحه درباره ما
     */
    public function update(Request $request)
    {
        $request->validate([
            'hero_title'       => 'required|string',
            'hero_description' => 'required|string',
        ]);

        $about = Pages::where('slug', 'about')->first() ?? new Pages();

        // ---- بخش هرو ----
        $about->hero_title        = $request->input('hero_title');
        $about->hero_description  = $request->input('hero_description');
        $about->hero_button_text  = $request->input('hero_button_text');
        $about->hero_button_link  = $request->input('hero_button_link');

        // آپلود تصاویر هرو
        $heroImages = $about->hero_images ?? [];
        if ($request->hasFile('hero_images')) {
            foreach ($request->file('hero_images') as $file) {
                $filename   = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/about'), $filename);
                $heroImages[] = '/upload/about/' . $filename;
            }
        }
        $about->hero_images = $heroImages;

        // ---- بخش دلایل انتخاب ----
        $about->why_title = $request->input('why_title');
        $whyItems = [];
        foreach ((array) $request->input('why_icon_svg', []) as $i => $svg) {
            $whyItems[] = [
                'icon_svg'    => $svg,
                'title'       => $request->input('why_item_title.' . $i, ''),
                'description' => $request->input('why_item_desc.' . $i, ''),
            ];
        }
        $about->why_items = $whyItems;

        // ---- بخش مراحل ----
        $about->steps_title = $request->input('steps_title');

        // آپلود تصویر مراحل
        if ($request->hasFile('steps_image')) {
            $file     = $request->file('steps_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/about'), $filename);
            $about->steps_image = '/upload/about/' . $filename;
        }

        $stepsItems = [];
        foreach ((array) $request->input('step_title', []) as $i => $title) {
            $stepsItems[] = [
                'number'      => $i + 1,
                'title'       => $title,
                'description' => $request->input('step_desc.' . $i, ''),
            ];
        }
        $about->steps_items = $stepsItems;

        // ---- بخش تیم ----
        $about->team_title = $request->input('team_title');
        $teamMembers       = $about->team_members ?? [];

        // حذف اعضا
        $deletedIndexes = (array) $request->input('delete_member', []);

        $newMembers = [];
        foreach ((array) $request->input('member_name', []) as $i => $name) {
            if (in_array($i, $deletedIndexes)) {
                continue;
            }

            $photo = $teamMembers[$i]['photo'] ?? '';
            if ($request->hasFile('member_photo.' . $i)) {
                $file     = $request->file('member_photo')[$i];
                $filename = time() . '_' . $i . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/about/team'), $filename);
                $photo = '/upload/about/team/' . $filename;
            }

            $newMembers[] = [
                'name'      => $name,
                'role'      => $request->input('member_role.' . $i, ''),
                'photo'     => $photo,
                'facebook'  => $request->input('member_facebook.' . $i, ''),
                'twitter'   => $request->input('member_twitter.' . $i, ''),
                'instagram' => $request->input('member_instagram.' . $i, ''),
            ];
        }
        $about->team_members = $newMembers;

        // ---- بخش نظرات ----
        $about->testimonials_title = $request->input('testimonials_title');
        $testimonials              = [];
        foreach ((array) $request->input('testimonial_text', []) as $i => $text) {
            $logo = $about->testimonials[$i]['logo'] ?? '';
            if ($request->hasFile('testimonial_logo.' . $i)) {
                $file     = $request->file('testimonial_logo')[$i];
                $filename = time() . '_t' . $i . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/about'), $filename);
                $logo = '/upload/about/' . $filename;
            }

            $testimonials[] = [
                'text'        => $text,
                'company'     => $request->input('testimonial_company.' . $i, ''),
                'person_name' => $request->input('testimonial_person.' . $i, ''),
                'person_role' => $request->input('testimonial_role.' . $i, ''),
                'logo'        => $logo,
            ];
        }
        $about->testimonials = $testimonials;

        // ---- بخش CTA ----
        $about->cta_title       = $request->input('cta_title');
        $about->cta_description = $request->input('cta_description');
        $about->cta_button_text = $request->input('cta_button_text');
        $about->cta_button_link = $request->input('cta_button_link');

        if ($request->hasFile('cta_image')) {
            $file     = $request->file('cta_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/about'), $filename);
            $about->cta_image = '/upload/about/' . $filename;
        }

        $about->date_updated = now()->format('Y-m-d H:i:s');
        $about -> slug = 'about';
        $about->save();

        return redirect()->back()->with('success', 'اطلاعات صفحه درباره ما با موفقیت ذخیره شد.');
    }
}
