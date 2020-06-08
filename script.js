var addBookForm = document.getElementById('books__form');

function getForm() {
  document.getElementById('books__form').style.display = "block";
}

function getOutForm() {
  document.getElementById('books__form').style.display = "none";
}
/////////////////////////////////////////////////////////////
function checkForm() {
  var a = document.getElementsByClassName('form__item');
  for (var i = 0; i < a.length; i++) {
    if (a[i].value == "") {
      a[i].style = "border: 2px solid #f00;";
    }
  }
}
/////////////////////////////////////////////////////////////

var deleteButtons = document.querySelectorAll('.delete');

addEventListener('click', deleteClick);

function deleteClick() {
  for (var i = 0; i < deleteButtons.length; i++) {
    if (event.target == deleteButtons[i]) {
      req();
      event.target.parentNode.remove();
      alert("Книга удалена");
    }
  }
}


/////////////////////////////////////////////////////////////
function req(id) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'delete.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(id);


  xhr.onreadystatechange = handleFunc;



  function handleFunc() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.response);

    }
  }
}

/////////////////////////////////////////////////////////////

function identy(id) {
  req(id);
}

/////////////////////////////////////////////////////////////
