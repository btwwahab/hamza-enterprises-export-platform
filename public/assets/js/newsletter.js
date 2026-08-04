/* newsletter.js — footer newsletter signup, loaded on every page */
document.getElementById('newsletterForm').addEventListener('submit', e => {
  e.preventDefault();
  const input = e.target.querySelector('input');
  const btn = e.target.querySelector('button');
  const original = btn.textContent;
  const email = input.value;
  const token = document.querySelector('meta[name="csrf-token"]').content;

  btn.disabled = true;
  fetch('/newsletter', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
      'X-CSRF-TOKEN': token,
    },
    body: JSON.stringify({ email }),
  })
    .then(res => {
      if (!res.ok) throw new Error('failed');
      input.value = '';
      btn.textContent = 'Subscribed ✓';
    })
    .catch(() => {
      btn.textContent = 'Try again';
    })
    .finally(() => {
      btn.disabled = false;
      setTimeout(() => { btn.textContent = original; }, 2200);
    });
});
