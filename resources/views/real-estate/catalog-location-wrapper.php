


    <main class="page-wrapper">

        <div class="container-fluid mt-5 pt-5 p-0">
            <div class="row g-0 mt-n3">

            
                <!-- محتوای اصلی صفحه -->
                <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">

                    <!-- نقشه (اختیاری) -->
                    <div class="map-popup invisible" id="map">
                        <button class="btn btn-icon btn-light btn-sm shadow-sm rounded-circle" type="button" data-bs-toggle-class="invisible" data-bs-target="#map">
                            <i class="fi-x fs-xs"></i>
                        </button>
                        <div class="interactive-map"></div>
                    </div>

              

          

                    <!-- لیست املاک -->
                    <div id="properties-container" class="row g-4 py-4">
                        <?php
                        function getCat($type)
                        {
                            switch ($type) {
                                case 'other':
                                    return "سایر";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش";
                                    break;
                                case 'villa-sale':
                                    return "خرید و فروش ویلا";
                                    break;
                                case 'apartment-rent':
                                    return "رهن و اجاره خانه و آپارتمان";
                                    break;
                                case 'apartment-sale':
                                    return "خرید و فروش خانه و آپارتمان";
                                    break;
                                case 'villa-short-rent':
                                    return "اجاره کوتاه مدت ویلا، سوئیت";
                                    break;
                                case 'commercial-rent':
                                    return "رهن و اجاره اداری، تجاری و صنعتی";
                                    break;
                                case 'commercial-sale':
                                    return "خرید و فروش اداری، تجاری و صنعتی";
                                    break;
                                case 'land':
                                    return "زمین و باغ";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش و مشارکت در ساخت";
                                    break;

                                default:
                                    break;
                            }
                        }
                        ?>


                        @if(isset($properties))
                        @foreach($properties as $p)


                  
                        <?php
                        $media = [""];
                        $cat = $properties[0]->category;
                        if (isset($p->media) && count(json_decode($p->media)) > 0) {
                            $media = json_decode($p->media);
                        }

                        ?>

                        @include("peroperty.vendor.".$cat)

                        @endforeach

                        @else

                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">این مشاور هنوز هیچ آگهی ثبت نکرده است.</p>
                        </div>
                        @endif

                    </div>

           

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {

                $('#sortby').on('change', function() {
                    let sort = $(this).val();

                    $.ajax({
                        url: "{{ route('catalog') }}",
                        method: 'GET',
                        data: {
                            type: "{{ request('type', 'sale') }}",
                            sort: sort,
                            // سایر فیلترها بعداً اضافه می‌شوند
                        },
                        success: function(response) {
                            $('#properties-container').html(response.html);
                            $('#results-count').text(response.total + ' نتیجه یافت شد');
                        }
                    });
                });

            });
        </script>
