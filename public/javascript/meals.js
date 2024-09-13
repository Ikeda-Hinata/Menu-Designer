document.addEventListener('DOMContentLoaded', function() {
    // すべての「add」ボタンを取得
    const addButtons = document.getElementsByClassName('add');
    
    // 各「add」ボタンにクリックイベントリスナーを追加
    Array.from(addButtons).forEach(button => {
        button.addEventListener('click', function() {
            const td = this.parentElement;
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = td.querySelector('input').name; // 同じname属性を使用
            td.insertBefore(newInput, this);
        });
    });

    // すべての「remove」ボタンを取得
    const removeButtons = document.getElementsByClassName('remove');

    // 各「remove」ボタンにクリックイベントリスナーを追加
    Array.from(removeButtons).forEach(button => {
        button.addEventListener('click', function() {
            const td = this.parentElement;
            const inputs = td.getElementsByTagName('input');
            if (inputs.length > 1) { // 少なくとも1つの入力フィールドが残るようにする
                td.removeChild(inputs[inputs.length - 1]);
            }
        });
    });
});