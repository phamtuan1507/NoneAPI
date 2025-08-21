import './bootstrap';
import './slide.js';
import './animation.js';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file.then(file => new Promise((resolve, reject) => {
            const data = new FormData();
            data.append('upload', file);

            fetch('/admin/upload-image', {
                method: 'POST',
                body: data,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    resolve({ default: data.url });
                } else {
                    reject('Upload failed');
                }
            })
            .catch(error => reject(error));
        }));
    }

    abort() {
        // Hủy upload nếu cần
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const contentElements = document.querySelectorAll('#content');
    contentElements.forEach(element => {
        ClassicEditor
            .create(element, {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                initialData: element.innerHTML, // Load nội dung hiện tại từ div
            })
            .then(editor => {
                console.log('Editor initialized:', editor);
                // Lưu dữ liệu editor vào hidden input khi submit (nếu cần)
                const form = element.closest('form');
                if (form) {
                    form.addEventListener('submit', () => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'content';
                        hiddenInput.value = editor.getData();
                        form.appendChild(hiddenInput);
                    });
                }
            })
            .catch(error => {
                console.error('Error initializing editor:', error);
            });
    });
});
