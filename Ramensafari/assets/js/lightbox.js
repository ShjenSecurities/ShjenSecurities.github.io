(function () {
  const overlay = document.createElement('div');
  overlay.className = 'lb-overlay';

  const img = document.createElement('img');
  img.className = 'lb-img';
  img.alt = '';

  const close = document.createElement('button');
  close.className = 'lb-close';
  close.innerHTML = '&times;';
  close.setAttribute('aria-label', 'Close');

  overlay.appendChild(close);
  overlay.appendChild(img);
  document.body.appendChild(overlay);

  function open(src) {
    img.src = src;
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLb() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    img.src = '';
  }

  document.querySelectorAll('.entry-photo').forEach(function (photo) {
    photo.classList.add('lb-trigger');
    photo.addEventListener('click', function () { open(photo.src); });
  });

  overlay.addEventListener('click', function (e) {
    if (e.target !== img) closeLb();
  });

  close.addEventListener('click', closeLb);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeLb();
  });
})();
