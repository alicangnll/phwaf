# aliguard-phpwaf
AliGuard PHP WAF
<div id="readme" class="Box-body readme blob instapaper_body js-code-block-container">
    <article class="markdown-body entry-content p-3 p-md-6" itemprop="text"><h1><a id="user-content-aliguard-phpwaf" class="anchor" aria-hidden="true" href="#aliguard-phpwaf"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>aliguard-phpwaf</h1>
<p><a target="_blank" rel="noopener noreferrer" href="https://camo.githubusercontent.com/a3d4b5f45ec725328f5a41f6ed8a9b45f4bead21/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f636174732e6a7067"><img src="https://camo.githubusercontent.com/a3d4b5f45ec725328f5a41f6ed8a9b45f4bead21/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f636174732e6a7067" alt="1" data-canonical-src="https://ux0rdev.github.io/aliguard-phpwaf/cats.jpg" style="max-width:100%;"></a></p>
<p> Kodlardaki açıkları bulmaktan sıkıldınız mı ?</p>
<p> AliWAF sizin yerinize denetlesin :)</p>
<p> AliWAF SQL tabanlı çalışan bir programdır.</p>
<p> SQL veritabanına eklediğiniz kuralları sitenizde
</p><p>engeller. Böylece sayfalarca kodu incelemek yerine</p>
<p> tek bir adımda açıkları kapatabilirsiniz.</p>
<code>
  <h3><a id="user-content--yeni-güncelleme" class="anchor" aria-hidden="true" href="#-yeni-güncelleme"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a> Yeni Güncelleme!</h3>
  <p> - IP Ban Özelliği Geldi</p>
  <p> - Tema Eklendi</p>
  </code>
<h3><a id="user-content--nasıl-çalışır-" class="anchor" aria-hidden="true" href="#-nasıl-çalışır-"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a> Nasıl Çalışır </h3>
<p> Şimdilik link tabanlı çalışıyor.</p>
<p> Ancak gelecek güncellemede GET,POST,PUT vb. methodları</p>
<p> da denetleyebilecek.</p>
<code>
<pre>PHP Dosyanıza
require_once(“engelle.php”);
Şeklinde ekleyiniz.
</pre>
<h3><a id="user-content--resimler-" class="anchor" aria-hidden="true" href="#-resimler-"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a> Resimler </h3>
<a target="_blank" rel="noopener noreferrer" href="https://camo.githubusercontent.com/999ce55a7b24e134cfc9bdfe3c7398cca85ea510/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f42373042443446342d373233332d343839442d383139462d3146323930464433384634332e6a706567"><img src="https://camo.githubusercontent.com/999ce55a7b24e134cfc9bdfe3c7398cca85ea510/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f42373042443446342d373233332d343839442d383139462d3146323930464433384634332e6a706567" alt="1" data-canonical-src="https://ux0rdev.github.io/aliguard-phpwaf/B70BD4F4-7233-489D-819F-1F290FD38F43.jpeg" style="max-width:100%;"></a>
<a target="_blank" rel="noopener noreferrer" href="https://camo.githubusercontent.com/8ea2e23a567cdf08428be6b3d52daa133fd30f9f/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f36453339343435332d463842382d343745442d423334422d3935344232463239303438392e6a706567"><img src="https://camo.githubusercontent.com/8ea2e23a567cdf08428be6b3d52daa133fd30f9f/68747470733a2f2f757830726465762e6769746875622e696f2f616c6967756172642d7068707761662f36453339343435332d463842382d343745442d423334422d3935344232463239303438392e6a706567" alt="2" data-canonical-src="https://ux0rdev.github.io/aliguard-phpwaf/6E394453-F8B8-47ED-B34B-954B2F290489.jpeg" style="max-width:100%;"></a>
<table>
<tbody><tr>
<td>Login teması alıntıdır</td>
<td>Admin teması ve kullanıcı Ekleme yapılacak</td>
<td>Default user/pass : admin/1234</td>
</tr>
</tbody></table>
</code></article>
  </div>
