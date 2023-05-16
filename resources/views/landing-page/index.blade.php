@extends('layouts.default')

@section('title', 'Home')

@section('content')

<!-- Content -->
<main class="min-h-screen">

    <!-- Hero -->
    <section class="relative mt-12">
        <!-- Hero Image -->
        <div class="hidden lg:block lg:absolute lg:z-10 lg:top-0 lg:right-0" aria-hidden="true">
            <img src="{{ asset('/assets/frontsite/images/hero-image.png') }}"
                class="bg-cover bg-center object-cover object-center max-h-[580px]" alt="Hero Image" />
        </div>
        </div>

        <!-- Hero Description -->
        <div class="relative mx-auto max-w-7xl px-4 lg:px-14 lg:py-16">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-6">

                    <!-- Label New -->
                    <h1>
                        <div class="flex items-center">

                        </div>

                        <span class="mt-6 block text-4xl font-semibold sm:text-5xl">
                            <span class="block text-[#1E2B4F] leading-normal">Selamat Datang <br />Family Dental
                                Care</span>
                        </span>
                    </h1>
                    <!-- End Label New -->

                    <!-- Text -->
                    <div class="flex flex-wrap gap-16 mt-8">
                        <div class="flex items-center gap-4">

                        </div>
                        <div class="flex items-center gap-4">

                        </div>
                    </div>
                    <!-- Text -->

                    <!-- CTA Button -->

                    <!-- CTA Button -->

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Family Dental Care</h2>
                <p>{!! html_entity_decode($tentang -> informasi_umum) !!}</p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ asset('main/img/logo/'.$tentang -> foto_sampul) }}" class="img-fluid" alt=""
                        height="100%" width="100%">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <h3>Visi</h3>
                    <p class="fst-italic">
                        {!! html_entity_decode($tentang -> visi) !!}
                    </p>
                    <h3>Misi</h3>
                    <ul>
                        {!! html_entity_decode($tentang -> misi) !!}
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section id="doctor" class="mt-4 lg:mt-16">

        <div class="mx-auto max-w-7xl px-4 lg:px-14 py-14">
            <div class="section-title">
                <h3 class="text-[#1E2B4F] text-2xl font-semibold">List Dokter</h3>
                <p class="text-[#A7B0B5] mt-2">Membantu kehidupan Anda menjadi lebih baik</p>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12 lg:gap-10 mt-10">
                    @foreach ($dokter as $data)
                    <div class="relative">
                        <div class="w-full h-[350px] rounded-2xl overflow-hidden">
                            <a href="{{ Auth::check() ? '/appointment/'.Crypt::encrypt($data->id_dokter) : '/login' }}"
                                class="group">
                                <img src="{{ asset('img/dokter/'.$data->images) }}"
                                    class="w-full h-full bg-center bg-no-repeat object-cover object-center"
                                    alt="{{ $doctor_item->name ?? '' }}">
                                <div
                                    class="opacity-0 group-hover:opacity-100 transition-all ease-in absolute inset-0 bg-[#0D63F3] bg-opacity-70 flex justify-center items-center">
                                    <span class="text-[#0D63F3] font-medium bg-white rounded-full px-8 py-3">Book
                                        Now</span>
                                </div>
                            </a>
                        </div>
                        <div class="bg-[#0D63F3] px-4 py-2">
                            <h4 class="text-white text-sm mb-2">{{ $data->nama_dokter }}</h4>

                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
        </div>


    </section>

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Gallery</h2>

            </div>
            <div class="gallery-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach ($galeri as $data)
                    <div class="swiper-slide"><a class="gallery-lightbox"><img
                                src="{{ asset('/img/gallery/'.$data -> images) }}" class="img-fluid" alt=""></a>
                        <h4>{{ $data -> judul }}</h4>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Gallery Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Location & Contact</h2>
            </div>

        </div>

        <div>
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://maps.google.com/maps?q=family%20dental%20care&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="container">

            <div class="row mt-5">

                <div class="col-lg">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>Our Address</h3>
                                <p>Jl. Leuwi Panjang No.52a, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa
                                    Barat
                                    40234</p>
                                <div class="info-box mt-4">
                                    <a href="https://www.google.com/maps/dir//Jl.+Leuwi+Panjang+No.52a,+Situsaeur,+Kec.
                                    +Bojongloa+Kidul,+Kota+Bandung,+Jawa+Barat+40234/@-6.9407825,107.5264023,12z/data
                                    =!4m8!4m7!1m0!1m5!1m1!1s0x2e68e8bd6cd8c397:0x1d7b143e603986b2!2m2!1d107.5964429!2d-6.9407876"
                                        class="appointment-btn scrollto"><span class="d-none d-md-inline">G</span>O</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Us</h3>
                                <p>fdcbandung52@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Call Us</h3>
                                <p>085266379191</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
</main>
<!-- End Content -->

@endsection