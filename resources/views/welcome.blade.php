<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدونة</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header>
        <div class="title-social">
            <h1 style="color:#faa74a">الرئيسيه</h1>
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="between">
            <img src="{{ asset('logo/مخطوطة التجمع 2.png') }}" alt="">
        </div>
        <div class="logo">
            <img src="{{ asset('logo/التحالف الوطني للاصلاح لوكو.png') }}" alt="شعار المدونة">
        </div>
    </header>

    <div class="banner">
        <img src="{{ asset('logo/بنر موقع.jpg') }}" alt="بنر">
        <div class="banner-text">
            <img src="{{ asset('logo/مخطوطة د سليم بيضاء.png') }}" alt="اسم المدونة">
        </div>
    </div>

    <div class="news-section">
        <h2>الأخبار</h2>
        <div class="news-ticker">
            <p>أهلا بكم في موقعنا سيتم عرض هنا كل يوم خبر جديد</p>
        </div>
    </div>

        <!-- بداية المدونة -->
        <div class="container">
            @foreach($posts as $post)
                <div class="card mb-5 p-3" style="border: 1px solid #ddd; border-radius: 10px; text-align:right;">
                    <div class="card-header">
                        <strong style="font-size: 18px;">الأدمن</strong>
                        <span class="text-muted"> | {{ \Carbon\Carbon::parse($post->created_at)->locale('ar')->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $post->content }}</p>
                    </div>

                    @if($post->images)
                        @foreach (json_decode($post->images) as $images)

                            <img src="{{ asset($images) }}" class="card-img-top mb-3" alt="Post Image" style="border-radius: 10px;">

                        @endforeach
                    @endif

                    @if($post->video_path)
                        <video class="card-img-top mb-3" controls style="border-radius: 10px;">
                            <source src="{{ asset($post->video_path) }}" type="video/mp4">
                            متصفحك لا يدعم عرض الفيديو.
                        </video>
                    @endif

                    <livewire:comment-post :post="$post" />
                </div>
            @endforeach
        </div>



        <script>
            function toggleReplies(commentId) {
                var repliesDiv = document.getElementById('replies-' + commentId);
                repliesDiv.style.display = (repliesDiv.style.display === 'none') ? 'block' : 'none';
            }

            function toggleReplyForm(commentId) {
                var replyForm = document.getElementById('reply-form-' + commentId);
                replyForm.style.display = (replyForm.style.display === 'none') ? 'block' : 'none';
            }
        </script>




        <!-- نهاية المدونة -->

        <!-- بداية تذييل الصفحة -->
        <div class="container-fluid bg-dark text-light footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">



                        <div class="col-md-12 text-center text-md-end">

                            &copy; <a class="border-bottom" href="#">اسم موقعك</a>, جميع الحقوق محفوظة.
                            <!-- بنية روابط مدعومة -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- نهاية تذييل الصفحة -->

        <!-- الرجوع إلى الأعلى -->
    </div>

    <!-- JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
