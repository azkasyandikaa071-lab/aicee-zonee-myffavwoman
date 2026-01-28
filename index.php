<?php
$__fotoDir = "foto/";
$_fotoExist = is_dir($_fotoDir);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aicee-zonee</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins}
body{background:linear-gradient(120deg,#050818,#02030f);color:#fff;overflow-x:hidden}
canvas{position:fixed;inset:0;z-index:-2}

/* LOGIN */
.login{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center;
background:radial-gradient(circle at top,#1a1f55,#02030f)}
.login-box{background:rgba(0,0,0,.55);padding:44px;border-radius:28px;width:90%;max-width:380px;text-align:center}
.login-box h1{font-family:Playfair Display}
.login-box input{width:100%;padding:14px;margin:10px 0;border:none;border-radius:14px}
.login-box button{width:100%;padding:14px;border:none;border-radius:14px;background:#7b8cff;color:#fff}

/* HEADER */
.floating-header{
position:fixed;top:0;left:0;right:0;z-index:100;
display:flex;justify-content:space-between;align-items:center;
padding:12px 20px;background:rgba(0,0,0,.45);backdrop-filter:blur(14px)
}
.floating-header h3{font-family:Playfair Display}

/* SECTION */
section{padding:110px 20px;max-width:1100px;margin:auto}

/* OPENING */
.opening{text-align:center;background:radial-gradient(circle at top,rgba(255,255,255,.18),transparent);
padding:70px 20px;border-radius:32px}
.opening h1{font-size:3em;font-family:Playfair Display}

/* COUNTER */
.counter{display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-top:36px}
.time-box{background:rgba(255,255,255,.1);padding:22px;border-radius:22px;min-width:130px}
.time-box h2{font-size:2.4em}

/* FOTO GRID */
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:18px}
.grid img{
  width:100%;
  aspect-ratio:1/1;
  object-fit:cover;
  border-radius:18px;
  cursor:pointer;
  transition:.35s
}
.grid img:hover{transform:scale(1.06)}

/* PREVIEW */
.preview{position:fixed;inset:0;background:rgba(0,0,0,.88);display:none;align-items:center;justify-content:center;z-index:200}
.preview-box{display:flex;gap:25px;flex-wrap:wrap;max-width:92%}
.preview img{width:320px;height:320px;object-fit:cover;border-radius:25px}
.preview-text{background:rgba(255,255,255,.12);padding:30px;border-radius:25px}
.slide{opacity:0;animation:slide .8s forwards;margin-bottom:10px}
@keyframes slide{from{opacity:0;transform:translateX(-20px)}to{opacity:1}}

/* QUIZ */
.quiz{background:rgba(255,255,255,.1);padding:35px;border-radius:30px}
.choices button{width:100%;padding:15px;margin-bottom:12px;border:none;border-radius:16px;
background:rgba(255,255,255,.15);color:#fff}
.love-bar{height:10px;background:rgba(255,255,255,.2);border-radius:10px;overflow:hidden}
#loveFill{height:100%;width:0;background:linear-gradient(90deg,#ff7bbd,#9aa7ff);transition:.4s}

/* GAME */
.game{position:relative;height:340px;background:rgba(255,255,255,.08);border-radius:30px;overflow:hidden}
.heart{position:absolute;font-size:28px;cursor:pointer;animation:fall linear forwards}
@keyframes fall{to{top:120%}}
.pop{animation:pop .3s}
@keyframes pop{50%{transform:scale(1.4)}}
.hud{display:flex;justify-content:space-between;margin-top:12px;opacity:.85}

/* FX */
button:hover{box-shadow:0 0 18px rgba(140,160,255,.55);transform:translateY(-2px)}
.opening h1{text-shadow:0 0 25px rgba(255,255,255,.25)}
#loveFill{animation:pulse 1.4s infinite}
@keyframes pulse{0%,100%{opacity:.7}50%{opacity:1}}

.play-btn{
  padding:12px 24px;
  border:none;
  border-radius:20px;
  background:#ff7bbd;
  color:#fff;
  margin-bottom:12px;
}
</style>
</head>

<body>

<canvas id="stars"></canvas>

<div class="login" id="login">
  <div class="login-box">
    <h1>Aicee zonee</h1>
    <input id="nama" placeholder="Nama kamu">
    <input id="pw" type="password" placeholder="Password">
    <button onclick="masuk()">Masuk</button>
  </div>
</div>

<div class="floating-header">
  <h3>💫 Aicee-zone</h3>
  <div id="clock"></div>
</div>

<section class="opening">
  <h1>Hai, <span id="namaOut"></span></h1>
  <p>hallooow aicee, kamu tau ga sii aku suka sama kamu,
    Sejak 3 Agustus 2024
  CUKUP LAMA YAHH, Tapi selama ini gada tuh episode bosen pas suka sama kamu😜,
  
WEB INI BUKAN BUAT APA APA, AKU CUMAN MAU NUNJUKIN KALAU AKU SERIUS
#izinnn🙏😎</p>
  <div class="counter">
    <div class="time-box"><h2 id="days"></h2><p>Hari</p></div>
    <div class="time-box"><h2 id="hours"></h2><p>Jam</p></div>
    <div class="time-box"><h2 id="minutes"></h2><p>Menit</p></div>
  </div>
</section>

<section>
<h2>📸 Pictures of myy fav women</h2>
<div class="grid" id="fotoGrid"></div>
</section>

<section>
<h2> Kasih paham bozz!!</h2>
<div class="quiz">
  <small id="qProg"></small>
  <h3 id="qText"></h3>
  <div class="choices" id="choices">
    <button id="c0" onclick="jawab(0)"></button>
    <button id="c1" onclick="jawab(1)"></button>
    <button id="c2" onclick="jawab(2)"></button>
  </div>
  <div class="love-bar"><div id="loveFill"></div></div>
  <p id="qRes"></p>
</div>
</section>

<section>
<h2>🎮 Tangkap Hati</h2>
<button class="play-btn" id="playBtn">PLAY</button>
<div class="game" id="game"></div>
<div class="hud">
  <span id="score">Skor: 0</span>
  <span id="time">30s</span>
  <span id="combo">Combo x0</span>
</div>
</section>

<div class="preview" id="preview" onclick="this.style.display='none'">
  <div class="preview-box">
    <img id="bigPhoto">
    <div class="preview-text" id="pptText"></div>
  </div>
</div>

<script>
/* LOGIN */
function masuk(){
 if(pw.value==="aicee" && nama.value){
  login.style.display="none";namaOut.innerText=nama.value
 }
}

/* CLOCK */
setInterval(()=>{
 const d=new Date()
 clock.innerText=d.getHours().toString().padStart(2,'0')+":"+d.getMinutes().toString().padStart(2,'0')
},1000)

/* COUNTER */
const start=new Date("2024-08-03T00:00:00")
setInterval(()=>{
 const diff=new Date()-start
 days.innerText=Math.floor(diff/86400000)
 hours.innerText=Math.floor(diff/3600000)%24
 minutes.innerText=Math.floor(diff/60000)%60
},1000)

/* FOTO TEXT (DIGANTI) */
const fotoText=[
["Senyumnya keliatan biasa","tapi kok aku berhenti lebih lama","ini jelas ga normal, dan aku sadar tapi tetep lanjut liatnya 😏 (9.5/10 ganggu fokus)"],
["Tatapan santai gitu","tapi efeknya ga santai ke aku","ini tipe yang bikin orang kejebak pelan-pelan 🙂 (10/10 bahaya laten)"],
["Hari ini harusnya biasa","tapi jadi kepikiran gara-gara ini","dan anehnya aku nikmatin kepikiran itu 😌 (9/10 bikin betah mikir)"],
["Foto random doang katanya","tapi kok rasanya kayak nyenggol","pelan tapi kena, kaya disenggol dikit tapi jatuh 😶 (8.8/10 licik)"],
["Aku inget foto ini","karena aku senyum sendiri","dan refleks mikir ‘kok bisa sih’ 😅 (9/10 senyum bocor)"],
["Ga ada drama","ga keliatan usaha","justru itu yang bikin aku ga bisa lepas 😏 (10/10 diam-diam mematikan)"],
["Waktu kerasa pelan","pas kamu muncul di frame","atau aku aja yang sengaja nahan biar ga selesai 🤨 (8.9/10 bikin lupa waktu)"],
["Cuma foto sebenernya","tapi rasanya kayak disapa","dan aku kejawab tanpa ngomong 🙂 (9.2/10 hangat ga sopan)"],
["Simpel sih","tapi justru itu yang bikin ribet","karena otak aku mulai kerja sendiri 😑 (8.7/10 overthinking starter)"],
["Aku balik ke foto ini","padahal niatnya lanjut scroll","gagal total dan malah betah 😮‍💨 (9.6/10 jebakan halus)"],
["Kamu keliatan santai","padahal auranya jalan terus","ini ga adil buat fokus aku 😌 (10/10 aura liar)"],
["Buat orang lain biasa","buat aku malah beda","dan aku males nyari alasan logisnya 🤷‍♂️ (9/10 bikin males rasional)"],
["Aku diem bukan kosong","lagi mikir dikit","dan ujung-ujungnya kamu lagi 😶 (8.9/10 konsisten ganggu)"],
["Kalo ditanya kenapa betah","aku juga bingung jawabnya","rasanya kaya tempat pulang 🙂 (9.7/10 bikin nyaman parah)"],
["Senyum kamu tuh","ga nyolok tapi nempel","kepikiran bahkan setelah layar mati 😏 (10/10 efek samping panjang)"],
["Hari ini keinget lagi","gara-gara foto ini","padahal aku ga ngundang perasaan 😅 (9/10 nyelonong aja)"],
["Tenang itu ternyata","bukan sepi","tapi kamu pas lagi biasa aja 😌 (9.8/10 tenang berisik)"],
["Ga pake pose ribet","ga keliatan dibuat","tapi kena tepat di bagian lemah 😏 (10/10 critical hit)"],
["Foto ini punya ceritanya","dan aku kebawa","tanpa mikir ini aman atau engga 😶 (9.3/10 rawan jatuh)"],
["Aku kalah pelan-pelan","sama caramu jadi diri sendiri","dan jujur aku ga pengen menang 😌 (10/10 kalah nikmat)"],
["Kelihatannya sederhana","tapi makin diliat makin nagih","bahaya tapi aku pura-pura santai 😏 (9.4/10 candu tipis)"],
["Aku sering balik ke sini","padahal ga ada alasan jelas","kayak nyari validasi buat rindu 😑 (8.8/10 alasan palsu)"],
["Ga banyak kata","tapi rasanya dapet","dan fokus aku langsung buyar 😮‍💨 (9/10 buyar elegan)"],
["Masuk galeri bentar","keluar dengan pikiran penuh","ini curang tapi aku ikhlas 😅 (9.5/10 permainan kotor)"],
["Bukan soal angle","bukan soal cahaya","tapi rasa yang muncul tiba-tiba 😌 (9/10 spontan berbahaya)"],
["Kamu di sini","bikin aku ngerasa aman","dan aku jarang ngerasain itu 😏 (10/10 zona aman ilegal)"],
["Foto ini bikin senyum dikit","tanpa sadar","terus mikir ‘kok gue gini sih’ 😅 (8.9/10 senyum bocor)"],
["Kalo lagi kangen","aku buka ini bentar","dan iya, aku ga bohong soal itu 😌 (9.6/10 kambuh)"],
["Aku suka versi kamu di sini","dan kali ini jujur","tanpa bercanda tanpa tameng 😏 (10/10 jujur bahaya)"],
["Di titik ini","aku sadar satu hal","kayaknya aku mau kamu dan ga mau pura-pura 🙂 (♾️/10 final boss)"]
]

for(let i=1;i<=30;i++){
 fotoGrid.innerHTML+=`<img src="foto${i}.jpg" onclick="openPhoto(${i-1})">`
}

function openPhoto(i){
 preview.style.display="flex"
 bigPhoto.src="foto"+(i+1)+".jpg"
 pptText.innerHTML=""
 fotoText[i].forEach((t,j)=>setTimeout(()=>{
  const d=document.createElement("div")
  d.className="slide"
  d.innerText=t
  if(j===0){d.style.fontSize="1.6em";d.style.fontFamily="Playfair Display"}
  if(j===1){d.style.fontSize="1.15em";d.style.opacity=".9"}
  if(j===2){d.style.fontSize=".95em";d.style.opacity=".75"}
  pptText.appendChild(d)
 },j*600))
}

/* QUIZ (DIBENERIN) */
const quiz=[
 {q:"Kalau aku tiba-tiba keinget kamu?",c:["biasa","senyum","kepikiran"],s:[1,2,3],r:["aku simpan","aku santai","aku kelepasan"]},
 {q:"Kamu nyaman ga ngobrol lama?",c:["kadang","iya","betah"],s:[1,2,3],r:["aku ngerti","aku nikmatin","aku lupa waktu"]},
 {q:"Kalau aku di samping kamu?",c:["biasa","tenang","nyaman"],s:[1,2,3],r:["aku jaga jarak","aku santai","aku betah"]},
 {q:"Menurut kamu aku perhatian?",c:["cukup","iya","kerasa"],s:[1,2,3],r:["aku pelan","aku lanjut","aku kebiasaan"]},
 {q:"Kalau aku lagi diem?",c:["biasa","nyari","nemenin"],s:[1,2,3],r:["aku mikir","aku luluh","aku aman"]},
 {q:"Kamu suka diperhatiin?",c:["ga terlalu","kadang","iya"],s:[1,2,3],r:["aku santai","aku ngerti","aku jaga"]},
 {q:"Kalau aku nanya kabar?",c:["sopan","peduli","berarti"],s:[1,2,3],r:["aku biasa","aku niat","aku ngaku"]},
 {q:"Kamu nyaman jadi diri sendiri?",c:["lumayan","iya","banget"],s:[1,2,3],r:["aku tunggu","aku lega","aku jatuh pelan"]},
 {q:"Kalau aku bilang kamu penting?",c:["makasih","percaya","aku tau"],s:[1,2,3],r:["aku simpan","aku jujur","aku niat"]},
 {q:"Kamu suka ngobrol sama aku?",c:["biasa","iya","sering"],s:[1,2,3],r:["aku santai","aku seneng","aku keterusan"]},
 {q:"Kalau aku ngajak ketemu?",c:["liat nanti","boleh","ayo"],s:[1,2,3],r:["aku nunggu","aku senang","aku siap"]},
 {q:"Kamu nyaman diem bareng?",c:["asing","tenang","enak"],s:[1,2,3],r:["aku mikir","aku nikmatin","aku betah"]},
 {q:"Kalau aku capek?",c:["istirahat","cerita","nemenin"],s:[1,2,3],r:["aku denger","aku ada","aku bersyukur"]},
 {q:"Kamu ngerasa aman?",c:["belum","kadang","iya"],s:[1,2,3],r:["aku jaga","aku konsisten","aku tinggal"]},
 {q:"Kalau aku butuh kamu?",c:["ngerti","usahain","dateng"],s:[1,2,3],r:["aku sadar","aku tenang","aku kelepasan lagi"]},
 {q:"Kamu gampang kangen?",c:["engga","kadang","iya"],s:[1,2,3],r:["aku senyum","aku paham","aku diem"]},
 {q:"Kalau aku ga sempurna?",c:["biasa","gapapa","diterima"],s:[1,2,3],r:["aku sadar","aku nyaman","aku bertahan"]},
 {q:"Kamu nyaman sama aku?",c:["cukup","iya","banget"],s:[1,2,3],r:["aku pelan","aku betah","aku ga buru-buru"]},
 {q:"Kalau aku ga chat duluan?",c:["biasa","nyari","nanya"],s:[1,2,3],r:["aku santai","aku keinget","aku senyum"]},
 {q:"Terakhir, kamu betah sama aku?",c:["liat nanti","iya","banget"],s:[1,2,3],r:["aku nunggu","aku seneng","aku ga kemana-mana"]}
]
let qi=0,love=0
function renderQuiz(){
 if(qi>=quiz.length){
  qText.innerText="Kamu lulus bucin 🤍"
  choices.style.display="none"
  return
 }
 qProg.innerText=`${qi+1}/${quiz.length}`
 qText.innerText=quiz[qi].q
 quiz[qi].c.forEach((t,i)=>document.getElementById("c"+i).innerText=t)
 qRes.innerText=""
}
function jawab(i){
 love+=quiz[qi].s[i]
 loveFill.style.width=Math.min(love*5,100)+"%"
 qRes.innerText=quiz[qi].r[i]
 qi++;setTimeout(renderQuiz,600)
}
renderQuiz()

/* GAME */
let scoreVal=0,comboVal=0,timeVal=30,playing=false
const types=[
 {icon:"❤️",score:1,speed:4},
 {icon:"💝",score:5,speed:3},
 {icon:"💔",score:-3,speed:5}
]
function spawn(){
 if(!playing)return
 const t=types[Math.floor(Math.random()*types.length)]
 const h=document.createElement("div")
 h.className="heart"
 h.innerText=t.icon
 h.style.left=Math.random()*90+"%"
 h.style.top="-30px"
 h.style.animationDuration=t.speed+"s"
 h.onclick=()=>{
  scoreVal+=t.score
  comboVal=t.score>0?comboVal+1:0
  h.classList.add("pop")
  h.remove()
  updateHUD()
 }
 game.appendChild(h)
 setTimeout(()=>h.remove(),t.speed*1000)
 setTimeout(spawn,500)
}
function updateHUD(){
 score.innerText="Skor: "+scoreVal
 combo.innerText="Combo x"+comboVal
}

/* PLAY */
playBtn.onclick=()=>{
 if(playing)return
 playing=true
 scoreVal=0;comboVal=0;timeVal=30
 score.innerText="Skor: 0";combo.innerText="Combo x0";time.innerText="30s"
 spawn()
 const timer=setInterval(()=>{
  if(!playing){clearInterval(timer);return}
  timeVal--;time.innerText=timeVal+"s"
  if(timeVal<=0){playing=false;clearInterval(timer)}
 },1000)
}

/* STARS */
const c=document.getElementById("stars"),x=c.getContext("2d")
function resize(){c.width=innerWidth;c.height=innerHeight}
resize();addEventListener("resize",resize)
let stars=[...Array(150)].map(()=>({x:Math.random()*c.width,y:Math.random()*c.height,r:Math.random()*1.5}))
;(function draw(){
 x.clearRect(0,0,c.width,c.height)
 x.fillStyle="#fff"
 stars.forEach(s=>{
  x.beginPath();x.arc(s.x,s.y,s.r,0,Math.PI*2);x.fill()
  s.y+=0.3;if(s.y>c.height)s.y=0
 })
 requestAnimationFrame(draw)
})()
</script>

<!-- TAMBAHAN #3 (PATCH FOTO HOSTING) -->
<script>
(function(){
  if(!<?php echo $__fotoExist ? 'true' : 'false'; ?>) return;

  const imgs = document.querySelectorAll('#fotoGrid img');
  imgs.forEach(img=>{
    const s = img.getAttribute('src');
    if(s && !s.includes('/')){
      img.src = 'foto/' + s;
    }
  });
})();
</script>
<!-- AKHIR TAMBAHAN #3 -->

</body>
</html>
