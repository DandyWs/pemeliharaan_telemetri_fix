let previewContainer = document.querySelector('.sampah-preview');
let previewBox = previewContainer.querySelectorAll('.preview')

document.querySelectorAll('.sampah .box').forEach(box =>{
    box.onclick = () =>{
        previewContainer.style.display = 'flex';
        let name = box.getAttribute('data-name');
        previewBox.forEach(preview =>{
            let target = preview.getAttribute('data-target');
            if (name == target) {
                preview.classList.add('active');
            }
        });
    };
});

previewBox.forEach(close =>{
    close.querySelector('.fa-times').onclick = () =>{
        close.classList.remove('active');
        previewContainer.style.display = 'none';
    };
});