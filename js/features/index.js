
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
  cta.setAttribute('data-soon','');
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