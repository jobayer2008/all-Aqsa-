<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['mName'] ?? '';
    $father = $_POST['mFather'] ?? '';
    $mother = $_POST['mMother'] ?? '';
    $mobile = $_POST['mMobile'] ?? '';
    $email = $_POST['mEmail'] ?? '';
    $current_addr = $_POST['mCurrentAddr'] ?? '';
    $permanent_addr = $_POST['mPermanentAddr'] ?? '';
    $dob = $_POST['mDob'] ?? '';
    $birth_reg = $_POST['mBirthReg'] ?? '';
    $nationality = $_POST['mNationality'] ?? '';
    $profession = $_POST['mProfession'] ?? '';
    $education = $_POST['mEducation'] ?? '';
    $blood = $_POST['mBlood'] ?? '';
    
    // Handle file uploads (photo and signature)
    $photo_path = '';
    $signature_path = '';
    
    // Upload directory
    $upload_dir = 'uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Upload photo
    if (isset($_FILES['mPhoto']) && $_FILES['mPhoto']['error'] == 0) {
        $photo_name = time() . '_photo_' . $_FILES['mPhoto']['name'];
        $photo_path = $upload_dir . $photo_name;
        move_uploaded_file($_FILES['mPhoto']['tmp_name'], $photo_path);
    }
    
    // Upload signature
    if (isset($_FILES['mSignature']) && $_FILES['mSignature']['error'] == 0) {
        $sig_name = time() . '_sig_' . $_FILES['mSignature']['name'];
        $signature_path = $upload_dir . $sig_name;
        move_uploaded_file($_FILES['mSignature']['tmp_name'], $signature_path);
    }
    
    // Email to send to
    $to = "ja0743358@gmail.com";
    $subject = "আল আকসা ফাউন্ডেশন - নতুন সদস্য আবেদন";
    
    // Email body (HTML)
    $message = "
    <html>
    <head>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
            .container { max-width: 700px; margin: 0 auto; padding: 20px; background: #f4f9f4; }
            .header { background: #0b3b2c; color: white; padding: 25px; text-align: center; border-radius: 10px 10px 0 0; }
            .header h2 { margin: 0; }
            .content { background: white; padding: 25px; border-radius: 0 0 10px 10px; }
            .field { margin: 12px 0; padding: 12px; border-bottom: 1px solid #eee; display: flex; }
            .label { font-weight: bold; color: #0b3b2c; min-width: 180px; }
            .value { color: #1e3a2f; }
            .photo-section { margin: 15px 0; padding: 15px; background: #f4f9f4; border-radius: 10px; text-align: center; }
            .photo-section img { max-width: 200px; border-radius: 10px; border: 2px solid #1a6b4a; }
            .footer { text-align: center; margin-top: 20px; padding: 15px; color: #666; background: #f4f9f4; border-radius: 10px; }
            .footer p { margin: 5px 0; }
            .badge { display: inline-block; background: #1a6b4a; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🤝 আল আকসা ফাউন্ডেশন</h2>
                <p style='margin:5px 0;'>নতুন সদস্য আবেদন</p>
                <span class='badge'>📅 " . date('d-m-Y H:i:s') . "</span>
            </div>
            <div class='content'>
                <h3 style='color:#0b3b2c; border-bottom:2px solid #1a6b4a; padding-bottom:10px;'>👤 আবেদনকারীর তথ্য</h3>
                
                <div class='field'><span class='label'>পূর্ণ নাম:</span><span class='value'>$name</span></div>
                <div class='field'><span class='label'>পিতার নাম:</span><span class='value'>$father</span></div>
                <div class='field'><span class='label'>মাতার নাম:</span><span class='value'>$mother</span></div>
                <div class='field'><span class='label'>মোবাইল নম্বর:</span><span class='value'>$mobile</span></div>
                <div class='field'><span class='label'>ইমেইল:</span><span class='value'>$email</span></div>
                <div class='field'><span class='label'>বর্তমান ঠিকানা:</span><span class='value'>$current_addr</span></div>
                <div class='field'><span class='label'>স্থায়ী ঠিকানা:</span><span class='value'>$permanent_addr</span></div>
                <div class='field'><span class='label'>জন্মতারিখ:</span><span class='value'>$dob</span></div>
                <div class='field'><span class='label'>জন্ম নিবন্ধন নম্বর:</span><span class='value'>" . ($birth_reg ?: 'প্রদান করা হয়নি') . "</span></div>
                <div class='field'><span class='label'>জাতীয়তা:</span><span class='value'>$nationality</span></div>
                <div class='field'><span class='label'>পেশা:</span><span class='value'>$profession</span></div>
                <div class='field'><span class='label'>শিক্ষাগত যোগ্যতা:</span><span class='value'>$education</span></div>
                <div class='field'><span class='label'>রক্তের গ্রুপ:</span><span class='value'>$blood</span></div>
                
                " . ($photo_path ? "
                <div class='photo-section'>
                    <h4 style='color:#0b3b2c;'>📸 আবেদনকারীর ছবি</h4>
                    <img src='$photo_path' alt='আবেদনকারীর ছবি'>
                </div>
                " : "") . "
                
                " . ($signature_path ? "
                <div class='photo-section'>
                    <h4 style='color:#0b3b2c;'>✍️ স্বাক্ষর</h4>
                    <img src='$signature_path' alt='স্বাক্ষর' style='max-width:150px;'>
                </div>
                " : "") . "
                
            </div>
            <div class='footer'>
                <p>🙏 ধন্যবাদ! আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।</p>
                <p style='font-size:0.9rem;'>© আল আকসা ফাউন্ডেশন | মদন, নেত্রকোনা</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@alaksa-foundation.com" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    // Send email
    if(mail($to, $subject, $message, $headers)) {
        $response = ['success' => true, 'message' => 'আপনার আবেদন সফলভাবে জমা হয়েছে! আমরা শীঘ্রই যোগাযোগ করব।'];
    } else {
        $response = ['success' => false, 'message' => 'ইমেইল পাঠাতে ব্যর্থ হয়েছে। দয়া করে আবার চেষ্টা করুন।'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>