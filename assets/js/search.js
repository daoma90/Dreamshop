let header = document.querySelector('.header');

const words_to_filter = [
  'and',
  'not',
  'if',
  'get',
  'with',
  'keep',
  'that',
  'this',
  'every',
  'is',
  'let',
  'go',
];
function checkForm(form) {
  let search = form.searchWord.value;
  if (search.length <= 1 || words_to_filter.includes(search.trim())) {
    form.reset();
    form.searchWord.placeholder = 'invalid Input';
    return false;
  }
  return true;
}
