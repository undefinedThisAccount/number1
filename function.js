// '' กับ "" ใช้ได้เหมือนกัน แต่พิมพ์เล็กพิมพ์ใหญ่ต้องเป๊ะ

function showpass() {
    document.querySelectorAll('#pass, #pass1').forEach(pass => pass.type = pass.type === 'password' ? 'text' : 'password');
}

// image preview function
/* กูก้ไม่รู้ทำไม function นี้เขียนไม่เหมือนอันอื่น กูลองเขียนแบบ " function img_upload(e){...} " แล้วแต่มันเออเร่อ
   ตอนแรกว่าจะเขียนอธิบายคำสั่งนี้ให้ แต่กูยังไม่เข้าใจกลัวมึง งง 
   กู console.log(ตัวแปร) แต่ละอันมาดูละกูโคตรงง */
img_upload.onchange = function(e){
    const file = e.target.files[0];
    if(file){
        preview.src = URL.createObjectURL(file); 
        // สร้าง URL ชั่วคราวจากไฟล์ที่ถูกเลือก แล้วมากำหนดที่ src ของ <img id="preview"> (มั้ง)
    }
}

// open & close qr code
// อันนี้คือตอนกดตัวเลือก เงินสด ก็จะปิดตัวเลือกโอนจ่าย
function close_qr(){
    // เก็บ id qr_code ลงตัวแปร qr
    var qr = document.getElementById('qr_code');
    // ลบ required ที่ <input id="slip"> ออก 
    document.getElementById('slip').required = false;
    // ลบ show ออก
    qr.classList.remove('show');

    // มีหรือไม่มีก้ได้
    var toggle = new bootstrap.Collapse(qr, {
        toggle: false
    });
}

function open_qr(){
    // เพิ่ม required ที่ <input id="slip">
    document.getElementById('slip').required = true;
}


// อันนี้ไม่จำเป็น แต่ถ้าไหวจะทำก้ได้ ไว้เช็คถ้าแก้ไขข้อมูลในฟอร์มถึงจะกดปุมได้
function form_change(){
    document.getElementsByName('submit')[0].disabled = false; // don't forget 's'
}