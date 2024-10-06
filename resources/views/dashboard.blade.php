<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة - إنشاء منشور</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            direction: rtl;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header .logout-button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            width: 150px;
            text-align: center;
            margin: 0 auto;
            display: block;
        }

        .header .logout-button:hover {
            background-color: #c82333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        textarea,
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #218838;
        }

        .file-input-label {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            border-radius: 4px;
            margin-top: 5px;
        }

        .file-input-label:hover {
            background-color: #0056b3;
        }

        .file-input {
            display: none;
        }

        .file-item {
            background-color: #f8f9fa;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cancel-button {
            background-color: #dc3545;
            color: white;
            border: none;
            width:fit-content;
            border-radius: 3px;
            cursor: pointer;
            font-size: 10px;
            padding: 2px 5px;
            margin-top: 15px;
        }

        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>لوحة الإدارة</h1>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="logout-button">تسجيل خروج</button>
        </form>
    </div>

    <div class="container">
        <h2>إنشاء منشور جديد</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="postForm" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="description">الوصف:</label>
            <textarea id="description" name="content" rows="4" placeholder="اكتب شيئاً مثيراً للاهتمام..." required></textarea>

            <label for="image" class="file-input-label">رفع صورة</label>
            <input type="file" id="image" name="images[]" accept="image/*" class="file-input" multiple>

            <label for="video" class="file-input-label">رفع فيديو</label>
            <input type="file" id="video" name="video_path" accept="video/*" class="file-input">

            <button type="submit">إرسال المنشور</button>
        </form>

        <!-- مكان عرض أسماء الملفات المختارة -->
        <div id="fileList" class="mt-3"></div>
        <div id="videoList" class="mt-3"></div>
    </div>

    <script>
        document.querySelector('.logout-button').addEventListener('click', function() {
            alert('تم تسجيل الخروج!');
        });

        // عرض أسماء الصور المختارة وإضافة زر إلغاء
        document.getElementById('image').addEventListener('change', function() {
            updateFileList('fileList', this.files, 'image');
        });

        document.getElementById('video').addEventListener('change', function() {
            updateFileList('videoList', this.files, 'video');
        });

        function updateFileList(elementId, files, type) {
            var fileList = document.getElementById(elementId);
            fileList.innerHTML = ''; // مسح المحتوى الحالي

            for (var i = 0; i < files.length; i++) {
                var listItem = document.createElement('div');
                listItem.className = 'file-item';
                listItem.innerText = (type === 'image' ? 'صورة: ' : 'فيديو: ') + files[i].name;

                var cancelButton = document.createElement('button');
                cancelButton.innerText = 'إلغاء';
                cancelButton.className = 'cancel-button';
                cancelButton.setAttribute('data-index', i);
                cancelButton.setAttribute('data-type', type);
                cancelButton.onclick = function() {
                    removeFile(this);
                };

                listItem.appendChild(cancelButton);
                fileList.appendChild(listItem);
            }
        }

        function removeFile(button) {
            var index = button.getAttribute('data-index');
            var type = button.getAttribute('data-type');

            var inputElement = document.getElementById(type);
            var dataTransfer = new DataTransfer();

            // إضافة الملفات التي لم يتم إلغاؤها إلى DataTransfer
            Array.from(inputElement.files).forEach((file, i) => {
                if (i != index) {
                    dataTransfer.items.add(file);
                }
            });

            // تحديث ملفات الإدخال
            inputElement.files = dataTransfer.files;

            // تحديث قائمة العرض
            updateFileList(type === 'image' ? 'fileList' : 'videoList', inputElement.files, type);
        }
    </script>
</body>
</html>
