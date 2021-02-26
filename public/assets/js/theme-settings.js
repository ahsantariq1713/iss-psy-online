let skin = localStorage.getItem('skin') || 'default';
let isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
let disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
// Disable unused skin immediately
disabledSkinStylesheet.setAttribute('rel', '');
disabledSkinStylesheet.setAttribute('disabled', true);
// add flag class to html immediately
if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
