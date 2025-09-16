<script>
    tinymce.init({
        selector: 'textarea',
        language: 'pl',
        height: 900,

        content_style: `
            body { text-align: justify; }

            img { cursor: pointer; }
            img:focus { outline: 2px dashed #007acc; }

            img.float-left {
                float: left;
                margin: 0 1.5rem 1rem 0;
                max-width: 45%;
                vertical-align: top;
            }

            img.float-right {
                float: right;
                margin: 0 0 1rem 1.5rem;
                max-width: 45%;
            }

            img.image-full {
                display: block;
                width: 100%;
                height: auto;
                margin: 1rem auto;
            }

            img.image-60 {
                display: block;
                width: 60%;
                height: auto;
                margin: 1rem auto;
            }
            figure.image {
                display: block;
                clear: none;
            }

            figure.image img {
                display: block;
                width: 100%;
                height: auto;
            }

            figure.image figcaption {
                font-size: 0.9em;
                color: #666;
                text-align: center;
                margin-top: 0.3em;
            }

            figure.image.float-left {
                float: left;
                margin: 0 1.5rem 1rem 0;
                max-width: 45%;
                vertical-align: top;
            }

            figure.image.float-right {
                float: right;
                margin: 0 0 1rem 1.5rem;
                max-width: 45%;
                vertical-align: top;
            }

            figure.image.image-full {
                display: block;
                margin: 1rem auto;
                width: 100%;
                max-width: 100%;
            }

            figure.image.image-60 {
                display: block;
                margin: 1rem auto;
                width: 60%;
                max-width: 100%;
            }

            figure.image.image-full img,
            figure.image.image-60 img {
                width: 100%;
                height: auto;
                display: block;
            }

            figure.image > img.image-60 {
                display: block;
                width: 60%;
                height: auto;
                margin: 1rem auto;
            }

            figure.image > img.image-full {
                display: block;
                width: 100%;
                height: auto;
                margin: 1rem auto;
            }

            img.float-left,
            figure.image.float-left {
                margin-right: 1.5rem;
                margin-bottom: 1rem;
            }

            img.float-right,
            figure.image.float-right {
                margin-left: 1.5rem;
                margin-bottom: 1rem;
            }

            @media (max-width: 768px) {
                /* IMG */
                img.float-left,
                img.float-right,
                img.image-full,
                img.image-60,

                    /* FIGURE */
                figure.image.float-right,
                figure.image.float-left,
                figure.image.image-60,
                figure.image.image-full {
                    float: none;
                    display: block;
                    margin: 1rem auto;
                    width: 100% !important;
                    max-width: 100%;
                }
            }

            .image-column-row {
                display: flex;
                justify-content: center;
                align-items: stretch; /* oba obrazki mają tę samą wysokość */
                margin: 1em 0;
            }

            .image-column-row img {
                height: 400px; /* wysokość stała */
                width: auto; /* szerokość proporcjonalna */
                object-fit: cover;
                border-radius: 8px;
            }
            @media (max-width: 768px) {
                .image-column-row {
                    flex-direction: column;
                    align-items: center;
                }

                .image-column-row img {
                    height: auto;
                    width: 90%;
                    margin: 0 0 1em 0;
                }
            }

            .image-row { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin: 1em 0; align-items: flex-start; }
            .image-row img { width: calc(50% - 10px); aspect-ratio: 4/3; object-fit: cover; border-radius: 8px; max-width: 100%; height: auto; }
            @media (max-width: 768px) { .image-row img { width: 100%; } }
        `,
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons',
            'image', 'link', 'lists', 'media', 'searchreplace',
            'table', 'visualblocks', 'wordcount', 'code'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | code | insertimagerow | insertimagecolumn | imagefull | imagesixty | floatleft | floatright',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        images_upload_credentials: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,
        image_caption: true,
        image_title: true,
        image_advtab: true,
        image_dimensions: true,
        object_resizing: true,
        extended_valid_elements: 'img[class|src|alt|width|height|style|title],figure[class],figcaption',

        setup: function (editor) {
            editor.ui.registry.addButton('insertimagerow', {
                text: '2 zdjęcia poziome obok',
                icon: 'image',
                tooltip: 'Wstaw dwa obrazy obok siebie',
                onAction: function () {
                    const html = `
                        <div class="image-row">
                            <img src="" alt="img 1" style="width: 45%;" />
                            <img src="" alt="img 2" style="width: 45%;" />
                        </div>
                    `;
                    editor.insertContent(html);
                }
            });

            editor.ui.registry.addButton('insertimagecolumn', {
                text: '2 zdjęcia pionowe obok',
                icon: 'image',
                tooltip: 'Wstaw dwa obrazki pionowe obok siebie (pełna wysokość)',
                onAction: function () {
                    const html = `
            <div class="image-column-row">
                <img src="" alt="img 1" style="height: 400px; width: auto; object-fit: cover; border-radius: 8px; margin-right: 10px;" />
                <img src="" alt="img 2" style="height: 400px; width: auto; object-fit: cover; border-radius: 8px;" />
            </div>
        `;
                    editor.insertContent(html);
                }
            });


            editor.ui.registry.addButton('imagefull', {
                text: 'Zdjęcie pełnej szerokości',
                icon: 'image',
                tooltip: 'Zdjęcie na 100% szerokości',
                onAction: function () {
                    const node = editor.selection.getNode();
                    const img = node.closest('img');

                    if (img) {
                        img.classList.remove('float-left', 'float-right', 'image-60');
                        img.classList.add('image-full');
                    }
                }
            });

            editor.ui.registry.addButton('imagesixty', {
                text: 'Zdjęcie 60%',
                icon: 'image',
                tooltip: 'Zdjęcie na 60% szerokości',
                onAction: function () {
                    const node = editor.selection.getNode();
                    const img = node.closest('img');

                    if (img) {
                        img.classList.remove('float-left', 'float-right', 'image-full');
                        img.classList.add('image-60');
                    }
                }
            });

            editor.ui.registry.addButton('floatleft', {
                text: 'Zdjęcie z lewej',
                icon: 'image',
                onAction: function () {
                    const node = editor.selection.getNode();
                    const figure = node.closest('figure');
                    const target = figure || node.closest('img');

                    if (target) {
                        target.classList.add('float-left');
                        target.classList.remove('float-right');
                    }
                }
            });

            editor.ui.registry.addButton('floatright', {
                text: 'Zdjęcie z prawej',
                icon: 'image',
                onAction: function () {
                    const node = editor.selection.getNode();
                    const figure = node.closest('figure');
                    const target = figure || node.closest('img');

                    if (target) {
                        target.classList.remove('float-left');
                        target.classList.add('float-right');
                    }
                }
            });
        },

        // 📤 Upload obrazków
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/tinymce/upload');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                xhr.upload.onprogress = function (e) {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = function () {
                    if (xhr.status !== 200) return reject('HTTP Error: ' + xhr.status);
                    const json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location !== 'string') return reject('Invalid JSON: ' + xhr.responseText);
                    resolve(json.location);
                };

                xhr.onerror = function () {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                const articleUuid = document.getElementById('article_uuid')?.value;
                if (articleUuid) formData.append('article_uuid', articleUuid);
                formData.append('type', 'article');

                xhr.send(formData);
            });
        },

        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],

        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
</script>
