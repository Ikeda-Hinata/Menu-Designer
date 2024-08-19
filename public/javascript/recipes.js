//フォームの追加
const inputs = document.getElementById('inputs');

const add = document.getElementById('add');
add.addEventListener('click', function() {
const input = document.createElement('input');
inputs.appendChild(input);
    });
//フォームの削除
const remove = document.getElementById('remove');
remove.addEventListener('click', function(){
inputs.removeChild(inputs.lastChild);
});


