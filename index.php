<?php
session_start();

// اگه کاربر لاگین بود، بفرستش داشبوردش
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'] ?? 'student';
    $redirects = [
        'teacher' => 'pages/teacher/dashboard.php',
        'parent'  => 'pages/parent/dashboard.php',
        'admin'   => 'pages/admin/dashboard.php',
        'staff'   => 'pages/admin/dashboard.php',
        'student' => 'pages/student/dashboard.php'
    ];
    header("Location: " . ($redirects[$role] ?? 'pages/student/dashboard.php'));
    exit;
}
?><!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Turkmen AI | هوش مصنوعی، همراه یادگیری شما</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
/* ============ پایه ============ */
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
html,body{overflow-x:hidden}
::selection{background:#2F63E8;color:#fff}
:root{
  --cream:#FEF8EC; --ink:#1F2B5E; --ink-soft:#5E6880;
  --blue:#2F63E8; --blue-d:#2450C8; --teal:#2E9E8F;
  --clay-out:0 24px 48px rgba(31,43,94,.10),0 8px 16px rgba(31,43,94,.06);
  --clay-in:inset 0 2px 3px rgba(255,255,255,.95),inset 0 -12px 24px rgba(224,208,168,.28);
}
body{
  font-family:"Vazirmatn",Tahoma,sans-serif;color:var(--ink);
  background:
    radial-gradient(620px 460px at calc(100% - 20px) 300px,rgba(246,197,110,.22),transparent 65%),
    radial-gradient(660px 520px at -40px 780px,rgba(126,200,195,.18),transparent 65%),
    var(--cream);
}
.container{max-width:1240px;margin:0 auto;padding:0 32px}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none;background:none}
svg{display:block}

@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes rise{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}
.rise{animation:rise .8s cubic-bezier(.22,.9,.3,1) both}
.d1{animation-delay:.05s}.d2{animation-delay:.15s}.d3{animation-delay:.25s}.d4{animation-delay:.35s}.d5{animation-delay:.45s}

/* ============ هدر ============ */
.header{display:flex;align-items:center;padding:22px 0 8px;position:relative;z-index:30}
.brand{display:flex;align-items:center;gap:10px}
.brand .logo{width:40px;height:40px;filter:drop-shadow(0 6px 10px rgba(47,99,232,.3))}
.brand-txt{display:flex;flex-direction:column;gap:1px}
.brand-name{font-size:19px;font-weight:800;color:#1D2A56;line-height:1.15}
.brand-tag{font-size:10.5px;font-weight:600;color:#8D95A9}
.menu{display:flex;align-items:center;gap:26px;margin-inline-start:34px}
.menu a{font-size:14.5px;font-weight:600;color:#3A4560;transition:color .2s;padding:6px 2px;border-radius:8px}
.menu a:hover{color:var(--blue)}
.actions{flex:1;display:flex;align-items:center;justify-content:space-between;margin-inline-start:70px}
.login{font-size:14.5px;font-weight:700;color:#2C3854;transition:color .2s}
.login:hover{color:var(--blue)}
.pill-btn{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(145deg,#fff,#FDF7EA);border:none;border-radius:999px;padding:10px 16px;font-size:13px;font-weight:700;color:#2C3854;box-shadow:var(--clay-out),var(--clay-in);transition:transform .2s}
.pill-btn:hover{transform:translateY(-2px)}
.pill-btn:active{transform:translateY(1px) scale(.97)}
.pill-btn .globe{width:17px;height:17px;color:var(--teal)}
.pill-btn .chev{width:13px;height:13px;color:#9AA2B4}

/* ============ هیرو ============ */
.hero{position:relative;display:grid;grid-template-columns:1fr 500px;align-items:center;gap:30px;padding-top:20px}
.hero-copy{position:relative;z-index:5;display:flex;flex-direction:column;align-items:flex-start;padding-top:10px}
.badge{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(145deg,#fff,#FDF7EA);border-radius:999px;padding:11px 18px;font-size:13px;font-weight:700;color:#2C3854;box-shadow:var(--clay-out),var(--clay-in)}
.badge svg{width:15px;height:15px;color:#4F7DF0}
.badge-hero{position:absolute;top:4px;inset-inline-end:-8px;z-index:6}
.hero h1{font-size:56px;line-height:1.26;font-weight:900;color:#202C60}
.hero h1 .hl{color:#2B62E8}
.hero p{margin-top:16px;font-size:16.5px;line-height:2.05;font-weight:500;color:var(--ink-soft);max-width:440px}
.cta{display:flex;align-items:center;gap:16px;margin-top:30px}
.btn{display:inline-flex;align-items:center;gap:11px;border-radius:18px;padding:16px 30px;font-size:15.5px;font-weight:800;transition:transform .22s,box-shadow .22s;position:relative}
.btn:active{transform:translateY(2px) scale(.98)}
.btn-primary{background:linear-gradient(180deg,#3D74F3 0%,#2450C8 100%);color:#fff;box-shadow:0 16px 30px rgba(43,98,224,.35),inset 0 2px 3px rgba(255,255,255,.45),inset 0 -6px 12px rgba(15,40,120,.35)}
.btn-primary:hover{transform:translateY(-2px)}
.btn-primary svg{width:18px;height:18px}
.btn-ghost{background:linear-gradient(145deg,#fff,#FDF7EA);color:#26314F;box-shadow:var(--clay-out),var(--clay-in)}
.btn-ghost:hover{transform:translateY(-2px)}
.btn-ghost svg{width:20px;height:20px;color:var(--blue)}

.feats{display:flex;align-items:stretch;margin-top:42px;width:100%;max-width:500px}
.feat{flex:1;display:flex;flex-direction:column;align-items:center;gap:10px;text-align:center;font-size:12.5px;font-weight:700;color:#3E4A66;line-height:1.7}
.feat-ico{width:52px;height:52px;border-radius:19px;background:linear-gradient(145deg,#E7F4F1,#D5EAE6);box-shadow:inset 0 2px 3px rgba(255,255,255,.95),inset 0 -9px 16px rgba(46,158,143,.22),0 12px 20px rgba(46,158,143,.14);display:flex;align-items:center;justify-content:center}
.feat-ico svg{width:26px;height:26px;color:var(--teal)}
.feat + .feat{border-inline-start:1px solid #EAE1CB;padding-inline-start:14px}

/* --- بخش تصویر --- */
.hero-visual{position:relative;z-index:2;display:flex;justify-content:center}
.hero-visual::before{content:"";position:absolute;inset:-30px -20px;background:radial-gradient(closest-side,rgba(47,99,232,.10),transparent 72%);z-index:0;border-radius:50%}
.hero-img{position:relative;z-index:2;width:100%;max-width:520px;border-radius:40px;box-shadow:0 40px 70px rgba(31,43,94,.16),0 12px 24px rgba(31,43,94,.08),var(--clay-in);animation:float 7s ease-in-out infinite;transform:perspective(1100px) rotateY(-7deg) rotateX(2deg);transition:transform .6s cubic-bezier(.22,.9,.3,1)}
.hero-img:hover{transform:perspective(1100px) rotateY(0) rotateX(0) scale(1.02)}
.hero-visual.img-failed .hero-img{display:none}
.scene-fallback{display:none;position:relative;width:100%;max-width:560px;height:560px;z-index:2}
.hero-visual.img-failed .scene-fallback{display:block}

/* --- صحنه جایگزین (فقط اگر تصویر نبود) --- */
.scene{position:absolute;inset:0}
.blob{position:absolute;background:radial-gradient(circle at 32% 28%,#D2EBE7 0%,#9FD3CD 55%,#7FBFB9 100%)}
.cloud{left:6%;top:0;width:150px;height:110px;border-radius:53% 47% 44% 56%/62% 56% 44% 38%;display:flex;align-items:center;justify-content:center;box-shadow:0 24px 44px rgba(110,170,164,.3),inset 0 6px 12px rgba(255,255,255,.5),inset 0 -12px 20px rgba(90,150,145,.25);z-index:2;animation:float 6s ease-in-out infinite}
.cloud .cstar{width:44px;height:44px;transform:rotate(14deg);filter:drop-shadow(0 4px 6px rgba(80,135,130,.35))}
.blob-bl{left:-6%;bottom:6%;width:250px;height:230px;border-radius:57% 43% 58% 42%/46% 60% 40% 54%;box-shadow:0 26px 50px rgba(110,170,164,.32),inset 0 8px 16px rgba(255,255,255,.4),inset 0 -14px 26px rgba(90,150,145,.3);z-index:1}
.blob-orange{right:-4%;top:8%;width:230px;height:290px;border-radius:55% 45% 52% 48%/58% 52% 48% 42%;background:radial-gradient(circle at 34% 28%,#F9D492 0%,#F2B45A 55%,#ECA23E 100%);box-shadow:0 30px 60px rgba(236,162,62,.28),inset 0 8px 16px rgba(255,255,255,.5),inset 0 -14px 26px rgba(190,120,30,.3);z-index:0;animation:float 8s ease-in-out infinite}
.mtn{position:absolute;left:34%;top:26%;width:320px;height:130px;opacity:.9;z-index:0}
.city{position:absolute;left:2%;top:30%;width:240px;height:96px;opacity:.95;z-index:1}
.ground{position:absolute;left:18%;bottom:12%;width:420px;height:66px;border-radius:50%;background:radial-gradient(ellipse at center,rgba(150,138,108,.20),transparent 68%);z-index:0}
.plus3d{position:absolute;left:10%;top:20%;width:56px;height:56px;z-index:4;filter:drop-shadow(0 12px 16px rgba(62,102,219,.32));animation:float 5.5s ease-in-out .4s infinite}
.star-badge{position:absolute;right:26%;top:4%;width:62px;height:62px;border-radius:50%;background:radial-gradient(circle at 33% 28%,#7AA0F4 0%,#2F5BDB 72%);box-shadow:0 18px 32px rgba(47,91,219,.38),inset 0 4px 8px rgba(255,255,255,.45),inset 0 -8px 14px rgba(20,45,130,.4);display:flex;align-items:center;justify-content:center;z-index:6;animation:float 5s ease-in-out infinite}
.star-badge svg{width:28px;height:28px;color:#fff;transform:rotate(15deg)}
.sqrt{position:absolute;right:22%;top:17%;width:66px;height:52px;z-index:5;filter:drop-shadow(0 8px 10px rgba(196,142,52,.35));animation:float 7s ease-in-out .8s infinite}
.xmark{position:absolute;right:18%;top:34%;width:52px;height:52px;z-index:5;filter:drop-shadow(0 10px 14px rgba(80,170,164,.35));animation:float 6s ease-in-out 1.2s infinite}
.rcard{position:absolute;left:50%;top:6%;transform:translateX(-50%) rotate(-2deg);width:300px;height:410px;background:linear-gradient(165deg,#FFFFFF 0%,#F8F3E8 100%);border-radius:44px;box-shadow:0 36px 70px rgba(135,124,98,.24),0 10px 20px rgba(135,124,98,.10),inset 0 3px 6px #fff,inset 0 -16px 30px rgba(210,195,160,.3);z-index:3;text-align:center;animation:float 7s ease-in-out infinite}
.rcard-title{padding-top:34px;font-size:17.5px;font-weight:800;color:#243055}
.rcard-sub{margin-top:5px;font-size:12.5px;font-weight:600;color:#9BA2B6}
.orb{position:absolute;right:26px;bottom:30px;width:36px;height:36px;border-radius:50%;background:radial-gradient(circle at 35% 28%,#AEC7F9 0%,#5B84EC 48%,#3157C2 100%);box-shadow:0 10px 18px rgba(49,87,194,.4),inset 0 3px 5px rgba(255,255,255,.55),inset 0 -6px 10px rgba(18,42,125,.4);z-index:4;animation:float 4.5s ease-in-out infinite}
.robot{position:absolute;left:50%;top:120px;transform:translateX(-50%);width:180px;z-index:3}
.antenna{position:absolute;left:50%;top:-28px;transform:translateX(-50%);width:6px;height:24px;background:linear-gradient(#E2E7EF,#CBD3E0);border-radius:3px;z-index:0}
.antenna::before{content:"";position:absolute;top:-15px;left:50%;transform:translateX(-50%);width:16px;height:16px;border-radius:50%;background:radial-gradient(circle at 35% 30%,#8FB2F6 0%,#3B67DB 75%);box-shadow:0 6px 10px rgba(59,103,219,.4)}
.ear{position:absolute;top:60px;width:22px;height:46px;border-radius:12px;background:linear-gradient(180deg,#628CF0 0%,#3B63D8 100%);z-index:1;box-shadow:inset 0 3px 6px rgba(255,255,255,.4),inset 0 -5px 8px rgba(30,60,150,.35)}
.ear.l{left:-10px}.ear.r{right:-10px}
.rhead{position:relative;z-index:2;width:180px;height:164px;background:linear-gradient(155deg,#FFFFFF 10%,#EFF2F7 85%);border-radius:52px;box-shadow:0 18px 30px rgba(108,118,148,.22),inset 0 4px 8px #fff,inset 0 -10px 18px rgba(172,182,208,.35)}
.screen{position:absolute;left:23px;right:23px;top:25px;bottom:27px;background:linear-gradient(158deg,#6494F3 0%,#3F6DE1 55%,#3359C9 100%);border-radius:34px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;box-shadow:inset 0 4px 10px rgba(255,255,255,.35),inset 0 -8px 14px rgba(25,55,150,.4)}
.eyes{display:flex;gap:18px}
.eyes i{display:block;width:26px;height:15px;border:6px solid #fff;border-bottom:none;border-radius:28px 28px 0 0}
.mouth{width:36px;height:16px;border:6px solid #fff;border-top:none;border-left-color:transparent;border-right-color:transparent;border-radius:0 0 30px 30px}
.rbody{position:relative;z-index:1;width:126px;height:44px;margin:-10px auto 0;background:linear-gradient(180deg,#FFF 0%,#E6EAF1 100%);border-radius:18px 18px 26px 26px;box-shadow:0 16px 26px rgba(108,118,148,.2)}
.book{position:absolute;display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;border-radius:12px 16px 16px 12px;text-shadow:0 2px 3px rgba(0,0,0,.18);box-shadow:0 22px 38px rgba(95,105,135,.28),inset 0 3px 8px rgba(255,255,255,.45),inset -6px -8px 16px rgba(0,0,0,.15);z-index:5}
.book::after{content:"";position:absolute;left:8px;right:8px;bottom:7px;height:9px;border-radius:5px;background:repeating-linear-gradient(90deg,#F7F9FC 0 4px,#DBE1EB 4px 6px);opacity:.92}
.book.blue{left:6%;bottom:14%;width:120px;height:176px;transform:rotate(-9deg);background:linear-gradient(152deg,#7493F3 0%,#4866D5 78%);font-size:19px;z-index:6}
.book.teal{left:20%;bottom:30%;width:90px;height:136px;transform:rotate(9deg);background:linear-gradient(152deg,#9ED5D0 0%,#6CB8B2 80%);font-size:15px}
.book.orange{right:6%;bottom:16%;width:104px;height:142px;transform:rotate(-17deg);background:linear-gradient(152deg,#F8C86A 0%,#EAA23A 80%);font-size:16px}

/* ============ نقش‌ها ============ */
.audience{position:relative;z-index:2;margin-top:48px}
.sec-head{text-align:center}
.sec-title{display:flex;align-items:center;justify-content:center;gap:16px}
.sec-title h2{font-size:31px;font-weight:900;color:#212D60}
.deco{display:flex;align-items:center;gap:9px}
.deco .ln{width:62px;height:2px;background:#DBD1B9;border-radius:2px}
.deco .dt{width:8px;height:8px;border-radius:50%;background:#59B9B1;box-shadow:0 3px 6px rgba(89,185,177,.4)}
.sec-sub{margin-top:9px;font-size:14px;font-weight:600;color:#6B7690}
.cards{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:40px}
.card{position:relative;background:linear-gradient(160deg,#fff 30%,#FDF8EC 100%);border-radius:26px;padding:22px 22px 52px;box-shadow:var(--clay-out),var(--clay-in);cursor:pointer;transition:transform .3s cubic-bezier(.22,.9,.3,1),box-shadow .3s;outline:none;text-align:right}
.card:hover,.card:focus-visible{transform:perspective(900px) translateY(-7px) rotateX(2.5deg);box-shadow:0 34px 60px rgba(31,43,94,.16),0 10px 20px rgba(31,43,94,.08),var(--clay-in)}
.card-top{display:flex;align-items:center;gap:14px}
.cicon{width:56px;height:56px;border-radius:20px;background:linear-gradient(145deg,#E9F0FE,#D8E5FD);box-shadow:inset 0 2px 3px rgba(255,255,255,.95),inset 0 -9px 16px rgba(47,99,232,.20),0 12px 20px rgba(47,99,232,.14);display:flex;align-items:center;justify-content:center;flex:none;transition:transform .3s}
.card:hover .cicon{transform:scale(1.08) rotate(-4deg)}
.cicon svg{width:30px;height:30px;color:var(--blue)}
.card h3{font-size:18px;font-weight:800;color:#243058}
.card p{margin-top:12px;font-size:13.5px;font-weight:600;color:#69738C;line-height:1.9}
.carrow{position:absolute;left:16px;bottom:14px;width:40px;height:40px;border-radius:50%;background:linear-gradient(180deg,#3D74F3,#2450C8);color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 18px rgba(47,99,232,.35),inset 0 2px 3px rgba(255,255,255,.4),inset 0 -5px 9px rgba(15,40,120,.35);transition:.25s}
.carrow svg{width:18px;height:18px}
.card:hover .carrow{transform:translateX(-4px) scale(1.08)}

/* ============ فوتر ============ */
.footer{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-top:64px;padding:14px 0 36px}
.f-love,.f-chip{display:flex;align-items:center;gap:7px;font-size:13px;font-weight:700;color:#46516B}
.f-love svg{width:16px;height:16px;color:#E4576A}
.f-chips{display:flex;align-items:center;gap:14px}
.f-chip{background:linear-gradient(145deg,#fff,#FDF7EA);border-radius:999px;padding:9px 15px;box-shadow:0 8px 16px rgba(186,175,146,.18),inset 0 2px 3px rgba(255,255,255,.9)}
.f-chip svg{width:16px;height:16px;color:var(--teal)}
.f-brand{display:flex;flex-direction:column;align-items:center;gap:4px}
.f-brand .row{display:flex;align-items:center;gap:9px}
.f-brand .logo{width:32px;height:32px}
.f-brand b{font-size:18.5px;font-weight:800;color:#1D2A56}
.f-brand span{font-size:12.5px;font-weight:600;color:#7C8497}

/* ============ مودال ============ */
.overlay{position:fixed;inset:0;background:rgba(31,43,94,.38);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity .3s;z-index:100}
.overlay.open{opacity:1;pointer-events:auto}
.modal{width:min(580px,100%);max-height:88vh;overflow-y:auto;background:linear-gradient(165deg,#fff 40%,#FDF8EC 100%);border-radius:36px;box-shadow:0 50px 100px rgba(31,43,94,.3),var(--clay-in);transform:translateY(30px) scale(.93);transition:transform .4s cubic-bezier(.34,1.56,.64,1);position:relative}
.overlay.open .modal{transform:none}
.modal-band{height:110px;border-radius:36px 36px 0 0;position:relative;display:flex;align-items:flex-end;justify-content:center}
.modal-icon{position:absolute;bottom:-36px;width:84px;height:84px;border-radius:28px;background:linear-gradient(145deg,#fff,#F2F5FB);box-shadow:0 16px 30px rgba(31,43,94,.18),inset 0 3px 5px #fff,inset 0 -10px 18px rgba(31,43,94,.08);display:flex;align-items:center;justify-content:center}
.modal-icon svg{width:44px;height:44px;color:var(--acc,#2F63E8)}
.modal-close{position:absolute;top:16px;inset-inline-start:16px;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,.85);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 16px rgba(31,43,94,.15),inset 0 2px 3px #fff;transition:.2s;z-index:2}
.modal-close:hover{transform:rotate(90deg)}
.modal-close svg{width:17px;height:17px;color:#3A4560}
.modal-body{padding:52px 36px 34px;text-align:center}
.modal-body h3{font-size:25px;font-weight:900;color:#212D60}
.modal-tag{margin-top:6px;font-size:13.5px;font-weight:700;color:var(--acc,#2F63E8)}
.modal-desc{margin-top:16px;font-size:14.5px;line-height:2.15;font-weight:500;color:#5E6880;text-align:right}
.modal-stats{display:flex;justify-content:center;gap:12px;margin-top:20px;flex-wrap:wrap}
.stat{background:linear-gradient(145deg,#fff,#FDF7EA);border-radius:16px;padding:10px 18px;box-shadow:0 8px 16px rgba(186,175,146,.18),inset 0 2px 3px rgba(255,255,255,.9)}
.stat b{display:block;font-size:16px;font-weight:900;color:var(--acc,#2F63E8)}
.stat span{font-size:11px;font-weight:700;color:#8D95A9}
.modal-features{list-style:none;margin-top:22px;display:grid;grid-template-columns:1fr 1fr;gap:12px;text-align:right}
.modal-features li{display:flex;align-items:center;gap:10px;background:linear-gradient(145deg,#fff,#FDF7EA);border-radius:16px;padding:12px 14px;font-size:13px;font-weight:700;color:#3E4A66;box-shadow:0 8px 16px rgba(186,175,146,.15),inset 0 2px 3px rgba(255,255,255,.9)}
.chk{flex:none;width:26px;height:26px;border-radius:50%;background:var(--soft,#E7EEFF);color:var(--acc,#2F63E8);display:flex;align-items:center;justify-content:center}
.chk svg{width:13px;height:13px}
.modal-cta{display:flex;gap:14px;justify-content:center;margin-top:26px}
.btn-acc{background:var(--grad,#3D74F3);color:#fff;box-shadow:0 14px 26px rgba(31,43,94,.22),inset 0 2px 3px rgba(255,255,255,.45),inset 0 -6px 12px rgba(15,40,120,.3)}

/* مودال ویدئو */
.video-frame{margin:0 36px 36px;aspect-ratio:16/9;border-radius:24px;background:linear-gradient(150deg,#3D74F3,#2450C8);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;box-shadow:inset 0 4px 8px rgba(255,255,255,.3),inset 0 -12px 24px rgba(15,40,120,.4),0 20px 40px rgba(43,98,224,.3)}
.video-frame .play{width:70px;height:70px;border-radius:50%;background:rgba(255,255,255,.95);display:flex;align-items:center;justify-content:center;animation:float 3.5s ease-in-out infinite}
.video-frame .play svg{width:28px;height:28px;color:var(--blue);margin-inline-start:4px}
.video-frame p{color:#fff;font-size:13.5px;font-weight:700;opacity:.9}

/* Toast */
.toast{position:fixed;bottom:26px;left:50%;transform:translate(-50%,20px);background:linear-gradient(145deg,#fff,#FDF7EA);border-radius:999px;padding:13px 24px;font-size:13.5px;font-weight:800;color:#2C3854;box-shadow:0 20px 40px rgba(31,43,94,.2),var(--clay-in);opacity:0;pointer-events:none;transition:.35s;z-index:200;white-space:nowrap}
.toast.show{opacity:1;transform:translate(-50%,0)}

/* ============ ریسپانسیو ============ */
@media (max-width:1120px){
  .menu{display:none}
  .actions{margin-inline-start:auto;justify-content:flex-end;gap:14px}
  .badge-hero{display:none}
  .hero{grid-template-columns:1fr;gap:34px}
  .hero-copy{align-items:center;text-align:center;max-width:640px;margin:0 auto}
  .hero p{max-width:520px}
  .cta,.feats{justify-content:center}
  .feats{max-width:540px}
}
@media (max-width:760px){
  .hero h1{font-size:38px}
  .cards{grid-template-columns:1fr 1fr;gap:14px}
  .feats{
    
        flex-direction: row;
        gap: 16px;
        display: flex;
        flex-wrap: wrap;
  }
  .feat + .feat{border-inline-start:none;padding-inline-start:0;border-top:1px solid #EAE1CB;padding-top:16px}
  .footer{flex-direction:column;gap:16px}
  .modal-features{grid-template-columns:1fr}
  .scene-fallback{height:440px}
  .rcard{width:250px;height:340px}
  .rhead,.robot{width:150px}
  .rhead{height:138px}
  .robot{top:100px}
}
@media (max-width:520px){
  .container{padding:0 18px}
  .cards{grid-template-columns:1fr}
  .hero h1{font-size:31px}
  .btn{padding:14px 22px;font-size:14px}
  .actions .login{display:none}
  .modal-body{padding:48px 22px 26px}
  .modal-cta{flex-direction:column}
}
@media (prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
</style>
</head>
<body id="top">

<!-- ================= هدر ================= -->
<header class="header container rise d1">
  <a href="#top" class="brand">
    <svg class="logo" viewBox="0 0 48 48" aria-hidden="true">
      <defs><linearGradient id="lgLogo" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#6D97F5"/><stop offset="1" stop-color="#2450C8"/></linearGradient></defs>
      <path d="M24 3C26.5 11 31.5 15.5 40 17.5 31.5 20.5 27 26.5 24 45 21 26.5 16.5 20.5 8 17.5 16.5 15.5 21.5 11 24 3Z" fill="url(#lgLogo)"/>
    </svg>
    <span class="brand-txt">
      <span class="brand-name">Turkmen AI</span>
      <span class="brand-tag">هوش مصنوعی برای آینده</span>
    </span>
  </a>
  <nav class="menu">
    <a href="#top">خانه</a>
    <a href="#roles">دوره‌ها</a>
    <a href="#" data-soon>ابزارها</a>
    <a href="#" data-soon>آموزش</a>
    <a href="#" data-soon>قیمت‌گذاری</a>
    <a href="#about">درباره ما</a>
  </nav>
  <div class="actions">
    <a href="#" class="login" data-soon>ورود / ثبت‌نام</a>
    <button class="pill-btn" data-soon>
      <svg class="globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.7 2.6 4 5.6 4 9s-1.3 6.4-4 9c-2.7-2.6-4-5.6-4-9s1.3-6.4 4-9z"/></svg>
      فارسی
      <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
    </button>
  </div>
</header>

<main>
<!-- ================= هیرو ================= -->
<section class="hero container">

  <span class="badge badge-hero rise d2">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1.8c.75 5.7 4.35 9.3 10.2 10.2-5.85.9-9.45 4.5-10.2 10.2C11.25 16.5 7.65 12.9 1.8 12 7.65 11.1 11.25 7.5 12 1.8z"/></svg>
    هوش مصنوعی برای آموزش
  </span>

  <div class="hero-copy rise d2">
    <span class="badge">یادگیری هوشمند، آینده روشن
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1.8c.75 5.7 4.35 9.3 10.2 10.2-5.85.9-9.45 4.5-10.2 10.2C11.25 16.5 7.65 12.9 1.8 12 7.65 11.1 11.25 7.5 12 1.8z"/></svg>
    </span>
    <h1>هوش مصنوعی،<br><span class="hl">همراه یادگیری شما</span></h1>
    <p>بات آموزشی Turkmen AI یادگیری را شخصی، هوشمند و الهام‌بخش می‌کند</p>
    <div class="cta">
      <a href="./pages/auth/register.php" id="mStartLink">
      <button class="btn btn-primary" >
        <span>شروع یادگیری</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M17 17L7 7"/><path d="M7 14V7h7"/></svg>
      </button>
      </a>
      
      <button class="btn btn-ghost" id="videoBtn">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.3v13.4L19.2 12z"/></svg>
        مشاهده ویدئو
      </button>
    </div>
    <div class="feats">
      <div class="feat">
        <span class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5l7.5 2.8v6.2c0 4.6-3.2 8.6-7.5 9.9-4.3-1.3-7.5-5.3-7.5-9.9V5.3z"/><path d="M9 11.8l2.1 2.1 4-4.2"/></svg></span>
        امن، مطمئن، همیشه همراه
      </div>
      <div class="feat">
        <span class="feat-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M10 3.5c.6 4.2 3.2 6.8 7.5 7.5-4.3.7-6.9 3.3-7.5 7.5-.6-4.2-3.2-6.8-7.5-7.5 4.3-.7 6.9-3.3 7.5-7.5z"/><path d="M18.6 14.3c.3 2 1.5 3.4 3.6 3.8-2.1.4-3.3 1.8-3.6 3.8-.3-2-1.5-3.4-3.6-3.8 2.1-.4 3.3-1.8 3.6-3.8z"/></svg></span>
        هوش مصنوعی پیشرفته
      </div>
      <div class="feat">
        <span class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M11.5 4A2.5 2.5 0 0 0 7 4.6a2.6 2.6 0 0 0-2 4.3 2.7 2.7 0 0 0 .4 4.7 2.7 2.7 0 0 0 2.4 4.6A2.5 2.5 0 0 0 12 19.7V4z"/><path d="M12.5 4A2.5 2.5 0 0 1 17 4.6a2.6 2.6 0 0 1 2 4.3 2.7 2.7 0 0 1-.4 4.7 2.7 2.7 0 0 1-2.4 4.6A2.5 2.5 0 0 1 12 19.7V4z"/></svg></span>
        یادگیری شخصی‌سازی‌شده
      </div>
    </div>
  </div>

  <!-- تصویر واقعی + صحنه جایگزین -->
  <div class="hero-visual rise d3" id="heroVisual">
    <img class="hero-img" src="assets/hero-robot.png" alt="دستیار هوشمند آموزشی Turkmen AI"
         onerror="document.getElementById('heroVisual').classList.add('img-failed')">
    <div class="scene-fallback" aria-hidden="true">
      <div class="scene">
      
    <img src="./assets/images/Ui_Ux images/herosection.png" 
    style="
    width: 135%;
    margin-right: -15%;
    filter: drop-shadow(7px 0px 7px #4e5a54ab);
    " alt="">

      
  </div>

    </div>
  </div>
</section>

<!-- ================= نقش‌ها ================= -->
<section class="audience container" id="roles">
  <div class="sec-head rise d3">
    <div class="sec-title">
      <span class="deco"><i class="ln"></i><i class="dt"></i></span>
      <h2>برای همه، در هر نقش</h2>
      <span class="deco"><i class="dt"></i><i class="ln"></i></span>
    </div>
    <p class="sec-sub">AI Turkmen همراه شماست — روی هر کارت کلیک کنید</p>
  </div>

  <div class="cards">

    <article class="card rise d3" data-role="student" tabindex="0" role="button" aria-haspopup="dialog">
      <div class="card-top">
        <span class="cicon"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5.4" r="2.9"/><path d="M5.6 19.8c.5-4 3.1-6.3 6.4-6.3s5.9 2.3 6.4 6.3z"/><rect x="8.4" y="14.9" width="7.2" height="4.9" rx="1.1" fill="#DCE7FD"/><path d="M10 16.4h4M10 18h4" stroke="#2F63E8" stroke-width="1.1" stroke-linecap="round"/></svg></span>
        <h3>دانش‌آموز</h3>
      </div>
      <p>یادگیری بهتر، هر روز — معلم خصوصی ۲۴ ساعته تو</p>
      <span class="carrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5.5"/><path d="M11.5 18l-6-6 6-6"/></svg></span>
    </article>

    <article class="card rise d4" data-role="parents" tabindex="0" role="button" aria-haspopup="dialog">
      <div class="card-top">
        <span class="cicon"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="8" cy="8.2" r="3"/><path d="M2.6 20c.5-3.8 2.8-6 5.4-6s4.9 2.2 5.4 6z"/><circle cx="17" cy="9.8" r="2.4" opacity=".85"/><path d="M13.6 20c.4-3 1.8-4.9 3.4-4.9s3 1.9 3.4 4.9z" opacity=".85"/><path d="M14.2 2.1c.5-.9 1.8-1 2.4-.1.6-.9 1.9-.8 2.4.1-.5 1.3-1.5 2-2.4 2.6-.9-.6-1.9-1.3-2.4-2.6z" fill="#8FB1F3"/></svg></span>
        <h3>والدین</h3>
      </div>
      <p>همراهی در مسیر رشد — با گزارش‌های شفاف و دقیق</p>
      <span class="carrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5.5"/><path d="M11.5 18l-6-6 6-6"/></svg></span>
    </article>

    <article class="card rise d4" data-role="teacher" tabindex="0" role="button" aria-haspopup="dialog">
      <div class="card-top">
        <span class="cicon"><svg viewBox="0 0 24 24" fill="currentColor"><rect x="2.5" y="2.8" width="19" height="12" rx="2"/><path d="M6 6.6h7.5M6 9.4h10" stroke="#fff" stroke-width="1.5" stroke-linecap="round" opacity=".95"/><circle cx="9.2" cy="17.6" r="2.1"/><path d="M5 22.6c.3-2.5 2-4 4.2-4s3.9 1.5 4.2 4z"/><path d="M13.2 15.6l3.2 4" stroke="#2F63E8" stroke-width="1.5" stroke-linecap="round"/></svg></span>
        <h3>معلم</h3>
      </div>
      <p>آموزش مؤثرتر، الهام‌بخش‌تر — دستیار هوشمند کلاس</p>
      <span class="carrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5.5"/><path d="M11.5 18l-6-6 6-6"/></svg></span>
    </article>

    <article class="card rise d5" data-role="manager" tabindex="0" role="button" aria-haspopup="dialog">
      <div class="card-top">
        <span class="cicon"><svg viewBox="0 0 24 24" fill="currentColor"><rect x="4.5" y="3.2" width="15" height="18.3" rx="2.5"/><rect x="8.8" y="1.6" width="6.4" height="3.4" rx="1.3" fill="#8FB1F3"/><path d="M8.2 9.4h7.6M8.2 12.8h7.6M8.2 16.2h4.8" stroke="#fff" stroke-width="1.7" stroke-linecap="round"/></svg></span>
        <h3>مدیر</h3>
      </div>
      <p>مدیریت هوشمند، تصمیم بهتر — همه‌چیز در یک نگاه</p>
      <span class="carrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5.5"/><path d="M11.5 18l-6-6 6-6"/></svg></span>
    </article>

  </div>
</section>
</main>

<!-- ================= فوتر ================= -->
<footer class="footer container rise d5" id="about">
  <div class="f-love">
    با <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C6.4 16.7 2.9 13.2 2.9 9.5c0-2.8 2.2-5 4.9-5 1.7 0 3.3.9 4.2 2.3.9-1.4 2.5-2.3 4.2-2.3 2.7 0 4.9 2.2 4.9 5 0 3.7-3.5 7.2-9.1 11z"/></svg> ساخته‌شده برای یادگیرندگان
  </div>
  <div class="f-brand">
    <div class="row">
      <svg class="logo" viewBox="0 0 48 48"><path d="M24 3C26.5 11 31.5 15.5 40 17.5 31.5 20.5 27 26.5 24 45 21 26.5 16.5 20.5 8 17.5 16.5 15.5 21.5 11 24 3Z" fill="url(#lgLogo)"/></svg>
      <b>Turkmen AI</b>
    </div>
    <span>یادگیری امروز، ساختن فردا</span>
  </div>
  <div class="f-chips">
    <span class="f-chip"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C6.4 16.7 2.9 13.2 2.9 9.5c0-2.8 2.2-5 4.9-5 1.7 0 3.3.9 4.2 2.3.9-1.4 2.5-2.3 4.2-2.3 2.7 0 4.9 2.2 4.9 5 0 3.7-3.5 7.2-9.1 11z"/></svg> انسان‌محور</span>
    <span class="f-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.5v-8.2"/><path d="M12 13.3c0-4.6 3.2-8 8.3-8.5-.5 5.1-3.7 8.5-8.3 8.5z"/><path d="M12 13.3c0-3.4-2.4-6-6.3-6.5.5 3.9 2.7 6.5 6.3 6.5z"/></svg> رشد پایدار</span>
    <span class="f-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.7 2.6 4 5.6 4 9s-1.3 6.4-4 9c-2.7-2.6-4-5.6-4-9s1.3-6.4 4-9z"/></svg> دسترسی جهانی</span>
  </div>
</footer>

<!-- ================= مودال نقش‌ها ================= -->
<div class="overlay" id="roleModal" aria-hidden="true">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="mTitle">
    <div class="modal-band" id="mBand">
      <span class="modal-icon" id="mIcon"></span>
    </div>
    <button class="modal-close" id="mClose"  aria-label="بستن" data-close>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div class="modal-body">
      <h3 id="mTitle"></h3>
      <div class="modal-tag" id="mTag"></div>
      <p class="modal-desc" id="mDesc"></p>
      <div class="modal-stats" id="mStats"></div>
      <ul class="modal-features" id="mFeatures"></ul>
      <div class="modal-cta">
      
      <!-- این id="mStartLink" رو اضافه کن -->
      <a href="" id="mStartLink">
         <button class="btn btn-acc" id="mStart">
            <span>همین حالا شروع کن</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M17 17L7 7"/><path d="M7 14V7h7"/></svg>
         </button>
      </a> 
      
      <button class="btn btn-ghost" data-close>بعداً</button>
      </div>
    </div>
  </div>
</div>

<!-- ================= مودال ویدئو ================= -->
<div class="overlay" id="videoModal" aria-hidden="true">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="vTitle">
    <button class="modal-close" data-close aria-label="بستن">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div class="modal-body">
      <h3 id="vTitle">ویدئو معرفی Turkmen AI</h3>
      <p class="modal-desc" style="text-align:center">در این ویدئو با قابلیت‌های بات آموزشی، نحوه شروع و تجربه یادگیری هوشمند آشنا می‌شوید.</p>
    </div>
    <div class="video-frame">
      <span class="play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.3v13.4L19.2 12z"/></svg></span>
      <p>ویدئو معرفی به‌زودی منتشر می‌شود 🎬</p>
    </div>
  </div>
</div>

<div class="toast" id="toast">این بخش به‌زودی فعال می‌شود 🚀</div>

<script>
/* ---------- داده نقش‌ها ---------- */
const ROLES = {
  student: {
    acc:'#2F63E8', soft:'#E7EEFF', grad:'linear-gradient(180deg,#3D74F3,#2450C8)',
    title:'دانش‌آموز', tag:'یادگیری بهتر، هر روز',
    desc:'بات آموزشی Turkmen AI مثل یک معلم خصوصی همیشه بیدار در کنار توست؛ هر سؤالی که داری — از ریاضی تا ادبیات — را قدم‌به‌قدم، ساده و با مثال‌های ملموس توضیح می‌دهد و مسیر مطالعه را دقیقاً متناسب با سطح و سرعت یادگیری تو می‌چیند.',
    stats:[['+۵۰هزار','دانش‌آموز فعال'],['۹۲٪','رضایت کاربران'],['۲۴/۷','پشتیبانی آنی']],
    features:['حل تمرین قدم‌به‌قدم با توضیح کامل','آزمون‌های هوشمند متناسب با سطح تو','برنامه مطالعه شخصی‌سازی‌شده','رفع اشکال آنی در هر ساعت شبانه‌روز']
  },
  parents: {
    acc:'#E4576A', soft:'#FCE9EC', grad:'linear-gradient(180deg,#EE6F80,#D23B50)',
    title:'والدین', tag:'همراهی در مسیر رشد',
    desc:'با داشبورد والدین همیشه از روند یادگیری فرزندت باخبر هستی؛ گزارش‌های هفتگی، نقاط قوت و ضعف هر درس و پیشنهادهای کاربردی برای همراهی بهتر در خانه را به‌سادگی و در چند ثانیه مشاهده می‌کنی — بدون نیاز به فنی بودن.',
    stats:[['هفتگی','گزارش پیشرفت'],['۱۰۰٪','شفافیت نتایج'],['۳ دقیقه','زمان مطالعه گزارش']],
    features:['گزارش پیشرفت هفتگی و ماهانه','مشاهده نقاط قوت و ضعف هر درس','تنظیم زمان مطالعه و محدودیت هوشمند','پیشنهاد فعالیت‌های یادگیری در خانه']
  },
  teacher: {
    acc:'#2E9E8F', soft:'#E4F4F1', grad:'linear-gradient(180deg,#35B1A0,#238276)',
    title:'معلم', tag:'آموزش مؤثرتر، الهام‌بخش‌تر',
    desc:'بات آموزشی دستیار توست، نه جایگزین تو؛ تولید برگه تمرین و آزمون استاندارد، تصحیح خودکار با بازخورد شخصی‌سازی‌شده و تحلیل دقیق عملکرد تک‌تک دانش‌آموزان را به تو می‌سپارد تا وقت بیشتری برای مهم‌ترین کار — تدریس و الهام‌بخشی — داشته باشی.',
    stats:[['۱۰ ساعت','صرفه‌جویی در هفته'],['+۵۰۰','سوال در بانک هوشمند'],['۹۸٪','دقت تصحیح خودکار']],
    features:['تولید محتوا و بانک سوال هوشمند','تصحیح خودکار با بازخورد شخصی','تحلیل عملکرد تک‌تک دانش‌آموزان','اتصال آسان به کلاس‌های موجود']
  },
  manager: {
    acc:'#E9A13B', soft:'#FDEFDD', grad:'linear-gradient(180deg,#F2AE4C,#D88A25)',
    title:'مدیر', tag:'مدیریت هوشمند، تصمیم بهتر',
    desc:'با داشبورد مدیریتی Turkmen AI تصویر کامل و لحظه‌ای از کل مدرسه در دستان توست؛ آمار مصرف، عملکرد کلاس‌ها، میزان پیشرفت تحصیلی و گزارش‌های قابل‌چاپ برای جلسات — همه در یک نگاه، همه بر پایه داده واقعی.',
    stats:[['لحظه‌ای','داشبورد عملکرد'],['+۳۰','نوع گزارش آماری'],['یک‌جا','مدیریت کل مدرسه']],
    features:['داشبورد لحظه‌ای عملکرد مدرسه','گزارش‌های آماری قابل‌چاپ و اشتراک‌گذاری','مدیریت دسترسی معلمان و دانش‌آموزان','تحلیل روند رشد تحصیلی در طول سال']
  }
};

/* ---------- المان‌ها ---------- */
const roleModal = document.getElementById('roleModal');
const videoModal = document.getElementById('videoModal');
const toastEl = document.getElementById('toast');
let lastFocus = null, toastTimer;

/* ---------- باز/بستن مودال نقش ---------- */
function openRole(key, trigger){
  const r = ROLES[key]; if(!r) return;
  lastFocus = trigger;
  const modal = roleModal.querySelector('.modal');
  modal.style.setProperty('--acc', r.acc);
  modal.style.setProperty('--soft', r.soft);
  document.getElementById('mBand').style.background =
    `linear-gradient(180deg, ${r.soft}, transparent)`;
  document.getElementById('mIcon').innerHTML =
    trigger.querySelector('.cicon').innerHTML;
  document.getElementById('mTitle').textContent = r.title;
  document.getElementById('mTag').textContent = r.tag;
  document.getElementById('mDesc').textContent = r.desc;
  document.getElementById('mStats').innerHTML =
    r.stats.map(s=>`<div class="stat"><b>${s[0]}</b><span>${s[1]}</span></div>`).join('');
  document.getElementById('mFeatures').innerHTML =
    r.features.map(f=>`<li><span class="chk"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.5l5 5L19.5 7"/></svg></span>${f}</li>`).join('');
  const cta = document.getElementById('mStart');
  cta.style.setProperty('--grad', r.grad);
  
  // ✅ منطق مسیردهی به جای data-soon
  const startLink = document.getElementById('mStartLink');
  if (key === 'manager') {
      // مدیر نمی‌تونه ثبت‌نام کنه، فقط ورود
      startLink.href = 'pages/auth/login.php';
  } else {
      // بقیه نقش‌ها برن به ثبت‌نام (کلید parents تبدیل به parent میشه)
      const roleParam = key === 'parents' ? 'parent' : key;
      startLink.href = `pages/auth/register.php?role=${roleParam}`;
  }

  openModal(roleModal);
}
function openModal(ov){
  ov.classList.add('open');
  ov.setAttribute('aria-hidden','false');
  document.body.style.overflow = 'hidden';
  const c = ov.querySelector('.modal-close'); if(c) c.focus();
}
function closeModals(){
  document.querySelectorAll('.overlay.open').forEach(ov=>{
    ov.classList.remove('open');
    ov.setAttribute('aria-hidden','true');
  });
  document.body.style.overflow = '';
  if(lastFocus){ lastFocus.focus(); lastFocus = null; }
}

/* ---------- اتصال کارت‌ها ---------- */
document.querySelectorAll('.card').forEach(card=>{
  card.addEventListener('click', ()=>openRole(card.dataset.role, card));
  card.addEventListener('keydown', e=>{
    if(e.key==='Enter' || e.key===' '){ e.preventDefault(); openRole(card.dataset.role, card); }
  });
});

/* ---------- دکمه‌های بستن و کلیک بیرون ---------- */
document.querySelectorAll('[data-close]').forEach(b=>b.addEventListener('click', closeModals));
document.querySelectorAll('.overlay').forEach(ov=>{
  ov.addEventListener('click', e=>{ if(e.target===ov) closeModals(); });
});
document.addEventListener('keydown', e=>{ if(e.key==='Escape') closeModals(); });

/* ---------- مودال ویدئو ---------- */
document.getElementById('videoBtn').addEventListener('click', ()=>openModal(videoModal));

/* ---------- Toast برای بخش‌های به‌زودی ---------- */
function showToast(msg){
  toastEl.textContent = msg;
  toastEl.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(()=>toastEl.classList.remove('show'), 2600);
}
document.addEventListener('click', e=>{
  const el = e.target.closest('[data-soon]');
  if(el){ e.preventDefault(); closeModals(); showToast('این بخش به‌زودی فعال می‌شود 🚀'); }
});

/* ---------- اطمینان از نمایش صحنه جایگزین اگر تصویر از قبل خطا خورده ---------- */
const heroImg = document.querySelector('.hero-img');
if(heroImg.complete && heroImg.naturalWidth === 0){
  document.getElementById('heroVisual').classList.add('img-failed');
}
</script>
</body>
</html>