<div class=" d-flex justify-content-end notranslate">
    <div  style="min-width:150px;max-width:200px!important">
        <select id="language-select" class="h-100 form-control  {{isset($small) && $small ? 'form-control-sm' : ''}}" data-placeholder="Change Language"
            onchange="doGTranslate(this);">
            <option value="en|af">Afrikaans</option>
            <option value="en|sq">Albanian - shqip</option>
            <option value="en|am">Amharic - አማርኛ</option>
            <option value="en|ar">Arabic - العربية</option>
            <option value="en|an">Aragonese - aragonés</option>
            <option value="en|hy">Armenian - հայերեն</option>
            <option value="en|ast">Asturian - asturianu</option>
            <option value="en|az">Azerbaijani - azərbaycan dili</option>
            <option value="en|eu">Basque - euskara</option>
            <option value="en|be">Belarusian - беларуская</option>
            <option value="en|bn">Bengali - বাংলা</option>
            <option value="en|bs">Bosnian - bosanski</option>
            <option value="en|br">Breton - brezhoneg</option>
            <option value="en|bg">Bulgarian - български</option>
            <option value="en|ca">Catalan - català</option>
            <option value="en|ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
            <option value="en|zh">Chinese - 中文</option>
            {{-- <option value="en|zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
            <option value="en|zh-CN">Chinese (Simplified) - 中文（简体）</option>
            <option value="en|zh-TW">Chinese (Traditional) - 中文（繁體）</option> --}}
            <option value="en|co">Corsican</option>
            <option value="en|hr">Croatian - hrvatski</option>
            <option value="en|cs">Czech - čeština</option>
            <option value="en|da">Danish - dansk</option>
            <option value="en|nl">Dutch - Nederlands</option>
            <option value="en|en">English</option>
            {{-- <option value="en|en-AU">English (Australia)</option>
            <option value="en|en-CA">English (Canada)</option>
            <option value="en|en-IN">English (India)</option>
            <option value="en|en-NZ">English (New Zealand)</option>
            <option value="en|en-ZA">English (South Africa)</option>
            <option value="en|en-GB">English (United Kingdom)</option>
            <option value="en|en-US">English (United States)</option> --}}
            <option value="en|eo">Esperanto - esperanto</option>
            <option value="en|et">Estonian - eesti</option>
            <option value="en|fo">Faroese - føroyskt</option>
            <option value="en|fil">Filipino</option>
            <option value="en|fi">Finnish - suomi</option>
            <option value="en|fr">French - français</option>
            {{-- <option value="en|fr-CA">French (Canada) - français (Canada)</option>
            <option value="en|fr-FR">French (France) - français (France)</option>
            <option value="en|fr-CH">French (Switzerland) - français (Suisse)</option> --}}
            <option value="en|gl">Galician - galego</option>
            <option value="en|ka">Georgian - ქართული</option>
            <option value="en|de">German - Deutsch</option>
            {{-- <option value="en|de-AT">German (Austria) - Deutsch (Österreich)</option>
            <option value="en|de-DE">German (Germany) - Deutsch (Deutschland)</option>
            <option value="en|de-LI">German (Liechtenstein) - Deutsch (Liechtenstein)</option>
            <option value="en|de-CH">German (Switzerland) - Deutsch (Schweiz)</option> --}}
            <option value="en|el">Greek - Ελληνικά</option>
            <option value="en|gn">Guarani</option>
            <option value="en|gu">Gujarati - ગુજરાતી</option>
            <option value="en|ha">Hausa</option>
            <option value="en|haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
            <option value="en|he">Hebrew - עברית</option>
            <option value="en|hi">Hindi - हिन्दी</option>
            <option value="en|hu">Hungarian - magyar</option>
            <option value="en|is">Icelandic - íslenska</option>
            <option value="en|id">Indonesian - Indonesia</option>
            <option value="en|ia">Interlingua</option>
            <option value="en|ga">Irish - Gaeilge</option>
            <option value="en|it">Italian - italiano</option>
            <option value="en|it-IT">Italian (Italy) - italiano (Italia)</option>
            <option value="en|it-CH">Italian (Switzerland) - italiano (Svizzera)</option>
            <option value="en|ja">Japanese - 日本語</option>
            <option value="en|kn">Kannada - ಕನ್ನಡ</option>
            <option value="en|kk">Kazakh - қазақ тілі</option>
            <option value="en|km">Khmer - ខ្មែរ</option>
            <option value="en|ko">Korean - 한국어</option>
            <option value="en|ku">Kurdish - Kurdî</option>
            <option value="en|ky">Kyrgyz - кыргызча</option>
            <option value="en|lo">Lao - ລາວ</option>
            <option value="en|la">Latin</option>
            <option value="en|lv">Latvian - latviešu</option>
            <option value="en|ln">Lingala - lingála</option>
            <option value="en|lt">Lithuanian - lietuvių</option>
            <option value="en|mk">Macedonian - македонски</option>
            <option value="en|ms">Malay - Bahasa Melayu</option>
            <option value="en|ml">Malayalam - മലയാളം</option>
            <option value="en|mt">Maltese - Malti</option>
            <option value="en|mr">Marathi - मराठी</option>
            <option value="en|mn">Mongolian - монгол</option>
            <option value="en|ne">Nepali - नेपाली</option>
            <option value="en|no">Norwegian - norsk</option>
            <option value="en|nb">Norwegian Bokmål - norsk bokmål</option>
            <option value="en|nn">Norwegian Nynorsk - nynorsk</option>
            <option value="en|oc">Occitan</option>
            <option value="en|or">Oriya - ଓଡ଼ିଆ</option>
            <option value="en|om">Oromo - Oromoo</option>
            <option value="en|ps">Pashto - پښتو</option>
            <option value="en|fa">Persian - فارسی</option>
            <option value="en|pl">Polish - polski</option>
            <option value="en|pt">Portuguese - português</option>
            <option value="en|pt-BR">Portuguese (Brazil) - português (Brasil)</option>
            <option value="en|pt-PT">Portuguese (Portugal) - português (Portugal)</option>
            <option value="en|pa">Punjabi - ਪੰਜਾਬੀ</option>
            <option value="en|qu">Quechua</option>
            <option value="en|ro">Romanian - română</option>
            <option value="en|mo">Romanian (Moldova) - română (Moldova)</option>
            <option value="en|rm">Romansh - rumantsch</option>
            <option value="en|ru">Russian - русский</option>
            <option value="en|gd">Scottish Gaelic</option>
            <option value="en|sr">Serbian - српски</option>
            <option value="en|sh">Serbo-Croatian - Srpskohrvatski</option>
            <option value="en|sn">Shona - chiShona</option>
            <option value="en|sd">Sindhi</option>
            <option value="en|si">Sinhala - සිංහල</option>
            <option value="en|sk">Slovak - slovenčina</option>
            <option value="en|sl">Slovenian - slovenščina</option>
            <option value="en|so">Somali - Soomaali</option>
            <option value="en|st">Southern Sotho</option>
            <option value="en|es">Spanish - español</option>
            {{-- <option value="en|es-AR">Spanish (Argentina) - español (Argentina)</option>
            <option value="en|es-419">Spanish (Latin America) - español (Latinoamérica)</option>
            <option value="en|es-MX">Spanish (Mexico) - español (México)</option>
            <option value="en|es-ES">Spanish (Spain) - español (España)</option>
            <option value="en|es-US">Spanish (United States) - español (Estados Unidos)</option> --}}
            <option value="en|su">Sundanese</option>
            <option value="en|sw">Swahili - Kiswahili</option>
            <option value="en|sv">Swedish - svenska</option>
            <option value="en|tg">Tajik - тоҷикӣ</option>
            <option value="en|ta">Tamil - தமிழ்</option>
            <option value="en|tt">Tatar</option>
            <option value="en|te">Telugu - తెలుగు</option>
            <option value="en|th">Thai - ไทย</option>
            <option value="en|ti">Tigrinya - ትግርኛ</option>
            <option value="en|to">Tongan - lea fakatonga</option>
            <option value="en|tr">Turkish - Türkçe</option>
            <option value="en|tk">Turkmen</option>
            <option value="en|tw">Twi</option>
            <option value="en|uk">Ukrainian - українська</option>
            <option value="en|ur">Urdu - اردو</option>
            <option value="en|ug">Uyghur</option>
            <option value="en|uz">Uzbek - o‘zbek</option>
            <option value="en|vi">Vietnamese - Tiếng Việt</option>
            <option value="en|wa">Walloon - wa</option>
            <option value="en|cy">Welsh - Cymraeg</option>
            <option value="en|fy">Western Frisian</option>
            <option value="en|xh">Xhosa</option>
            <option value="en|yi">Yiddish</option>
            <option value="en|yo">Yoruba - Èdè Yorùbá</option>
            <option value="en|zu">Zulu - isiZulu</option>
        </select>
        <div id="google_translate_element2"></div>
    </div>
</div>

<script type="text/javascript">
    function googleTranslateElementInit2() { new google.translate.TranslateElement({ pageLanguage: 'en', autoDisplay: true }, 'google_translate_element2'); }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
<script type="text/javascript">
    /* <![CDATA[ */
    eval(function (p, a, c, k, e, r) { e = function (c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) }; if (!''.replace(/^/, String)) { while (c--) r[e(c)] = k[c] || e(c); k = [function (e) { return r[e] }]; e = function () { return '\\w+' }; c = 1 }; while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]); return p }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
/* ]]> */
</script>

<style>
    #goog-gt-tt {
        display: none !important;
    }

    .goog-te-banner-frame {
        display: none !important;
    }

    .goog-te-menu-value:hover {
        text-decoration: none !important;
    }

    body {
        top: 0 !important;
    }

    #google_translate_element2 {
        display: none !important;
    }
</style>
