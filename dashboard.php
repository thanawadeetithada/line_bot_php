<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot UI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #fef9f9;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid #f4c8c8;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .input-box {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .input-box textarea {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .options button {
        text-align: center;
        padding: 10px;
        border: 1px solid #ff8ac8;
        background-color: transparent;
        color: #ff8ac8;
        border-radius: 5px;
        flex: 1;
        cursor: pointer;
    }

    .add-options {
        text-align: center;
        margin-top: 20px;
    }

    .add-options button {
        background-color: #ff8ac8;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
    }

    .add-sentence {
        margin: 0 0 10px 0;
    }

    .add-sentence button {
        background-color: transparent;
        color: #ff8ac8;
        padding: 5px 10px;
        border: 1px solid #ff8ac8;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
    }


    .add-keyword {
        margin: 0 0 20px 0;
    }

    .add-keyword button {
        background-color: transparent;
        color: #ff8ac8;
        padding: 5px 10px;
        border: 1px solid #ff8ac8;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
    }

    .keyword {
        h6 {
            margin-bottom: 3px;
        }
    }

    .add-same {
        margin: 0 0 20px 0;
    }

    .add-same button {
        background-color: transparent;
        color: #ff8ac8;
        padding: 5px 10px;
        border: 1px solid #ff8ac8;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
    }

    .same {
        h6 {
            margin-bottom: 3px;
        }
    }

    .add-word-select {
        margin: 0 0 20px 0;
    }

    .add-word-select button {
        background-color: transparent;
        color: #ff8ac8;
        padding: 5px 10px;
        border: 1px solid #ff8ac8;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
    }

    .word-select {
        h6 {
            margin-bottom: 3px;
        }
    }

    .custom-switch {
        margin-left: 2rem;
        transform: scale(1.5);
    }

    .custom-control-label {
        padding-top: 2px;
    }

    .warning {
        background-color: #fff3cd;
        color: #856404;
        padding: 10px;
        font-size: 12px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    label {
        margin-top: 10px;
        margin-bottom: 0px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="input-box">
            <textarea rows="2" placeholder="คำตอบของแชทบอท">ทดสอบ</textarea>
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="toggleSwitch">
                <label class="custom-control-label small" for="toggleSwitch">เปิดใช้งานบทสนทนา</label>
            </div>
        </div>
        <h6 style="border-top: 1px solid #ddd; padding-top: 10px;">เมื่อลูกค้าพิมพ์ว่า</h6>

        <h6 style="margin-bottom: 0px;">ประโยค❓</h6>
        <div class="sentence">
            <div class="btn-container">
            </div>
            <div class="add-sentence">
                <button id="add-btn" class="btn btn-outline-primary">+ เพิ่ม</button>
            </div>

        </div>

        <h6 style="margin-bottom: 0px;">คีย์เวิร์ด❓</h6>
        <div class="keyword">
            <div class="keyword-container">
            </div>
            <div class="add-keyword">
                <button id="keyword-btn" class="btn btn-outline-primary">+ เพิ่ม</button>
            </div>

        </div>

        <h6 style="margin-bottom: 0px;">เหมือนกับ❓</h6>
        <div class="same">
            <div class="same-container">
            </div>
            <div class="add-same">
                <button id="same-btn" class="btn btn-outline-primary">+ เพิ่ม</button>
            </div>

        </div>


        <div class="answer-chatbot">
            <h6>คำตอบของแชทบอท</h6>
            <div class="input-box">
                <i style="margin-right: 10px" class="fa-regular fa-trash-can"></i>
                <textarea rows="2" placeholder="คำตอบของแชทบอท">คำตอบ</textarea>
            </div>
        </div>
        <div class="warning">
            ⚠️ คำเตือน
        </div>

        <div class="add-item">
            <h6>เพิ่มไอเท็ม</h6>
            <div class="options">
                <button class="add-message">
                    <i class="fa-regular fa-comment-dots fa-2xl"></i><br>
                    <label>กล่องข้อความ</label>
                </button>
                <button class="add-btn">
                    <i class="fa-regular fa-comment-dots fa-2xl"></i><br>
                    <label>ปุ่มกด</label>
                </button>
                <button class="add-pic">
                    <i class="fa-regular fa-image fa-2xl"></i><br>
                    <label>รูปภาพ</label>
                </button>
                <button class="add-list">
                    <i class="fa-regular fa-rectangle-list fa-2xl"></i><br>
                    <label>เมนูลิสต์</label>
                </button>
                <button class="add-catalog">
                    <i class="fa-solid fa-cookie fa-2xl"></i><br>
                    <label>แค็ตตาล็อก</label>
                </button>
                <button class="add-sticker">
                    <i class="fa-regular fa-face-smile-beam fa-2xl"></i><br>
                    <label>ไลน์สติ๊กเกอร์</label>
                </button>
            </div>
        </div>

        <br>
        <h6 style="margin-bottom: 0px;">คำตัวเลือก</h6>
        <div class="word-select">
            <div class="word-select-container">
            </div>
            <div class="add-word-select">
                <button id="word-select-btn" class="btn btn-outline-primary">+ เพิ่มคำตัวเลือก</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-btn');
    const btnContainer = document.querySelector('.btn-container');

    const keywordBtn = document.getElementById('keyword-btn');
    const keywordContainer = document.querySelector('.keyword-container');

    const sameBtn = document.getElementById('same-btn');
    const sameContainer = document.querySelector('.same-container');

    const wordSelectBtn = document.getElementById('word-select-btn');
    const wordSelectContainer = document.querySelector('.word-select-container');

    // ฟังก์ชันสำหรับสร้างปุ่มใน btnContainer
    function createButtonForBtnContainer() {
        createDynamicButton(btnContainer);
    }

    // ฟังก์ชันสำหรับสร้างปุ่มใน keywordContainer
    function createButtonForKeywordContainer() {
        createDynamicButton(keywordContainer);
    }

    // ฟังก์ชันสำหรับสร้างปุ่มใน sameContainer
    function createButtonForSameContainer() {
        createDynamicButton(sameContainer);
    }

    // ฟังก์ชันสำหรับสร้างปุ่มใน wordSelectContainer
    function createButtonForWordSelectContainer() {
        createDynamicButton(wordSelectContainer);
    }

    function createDynamicButton(container) {
        const wrapperDiv = document.createElement('div');
        wrapperDiv.classList.add('btn', 'd-flex', 'align-items-center', 'justify-content-between');

        const input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control');
        input.style.width = 'auto';
        input.style.flexGrow = '1';
        input.placeholder = 'ใส่ข้อความ';

        const saveButton = document.createElement('button');
        saveButton.textContent = 'บันทึก';
        saveButton.classList.add('btn', 'btn-sm', 'btn-primary', 'ml-2', 'pl-2');

        const closeButton = document.createElement('button');
        closeButton.textContent = 'X';
        closeButton.classList.add('btn', 'btn-sm', 'btn-outline-danger', 'ml-2', 'pl-2', 'pr-2');

        closeButton.addEventListener('click', function () {
            container.removeChild(wrapperDiv);
        });

        wrapperDiv.appendChild(input);
        wrapperDiv.appendChild(saveButton);
        wrapperDiv.appendChild(closeButton);

        container.appendChild(wrapperDiv);

        saveButton.addEventListener('click', function () {
            const buttonText = input.value.trim();
            if (buttonText) {
                wrapperDiv.innerHTML = '';
                wrapperDiv.classList.remove('d-flex', 'align-items-center', 'justify-content-between');

                const newButton = document.createElement('button');
                newButton.textContent = buttonText;
                newButton.classList.add('btn-custom', 'd-flex', 'align-items-center');

                const deleteIconButton = document.createElement('i');
                deleteIconButton.classList.add('fa', 'fa-times', 'ml-2');
                deleteIconButton.style.cursor = 'pointer';

                deleteIconButton.addEventListener('click', function () {
                    container.removeChild(wrapperDiv);
                });

                newButton.appendChild(deleteIconButton);

                wrapperDiv.appendChild(newButton);
            }
        });

        const style = document.createElement('style');
        style.textContent = `
        .btn-custom {
            background-color: #ff8ac8;
            color: white;
            padding: 5px 10px;
            border: 1px solid #ff8ac8;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }

        .btn-custom i {
            margin-left: 5px;
            color: white;
        }
        .btn {
            padding-left: 0px;
            padding-right: 5px;
        }
    `;
        document.head.appendChild(style);
    }

    // เพิ่ม event listener ให้กับแต่ละปุ่ม
    addBtn.addEventListener('click', createButtonForBtnContainer);
    keywordBtn.addEventListener('click', createButtonForKeywordContainer);
    sameBtn.addEventListener('click', createButtonForSameContainer);
    wordSelectBtn.addEventListener('click', createButtonForWordSelectContainer);
});

    </script>
</body>

</html>