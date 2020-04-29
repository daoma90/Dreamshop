let header = document.querySelector('.header')
header.style.position='static'


const words_to_filter = ["and", "not", "if", "get", "with", "keep", "that", "this", "every", "is", 'let', 'go'];
function checkForm(form){
  let search = form.searchWord.value
  if (search.length <= 1 || words_to_filter.includes(search.trim()) ){
    // need fix modal for better user experince
    alert("Error: Input can't be empty or atleast tow character or can't be key word");
    return false;
  }
  return true
 
}