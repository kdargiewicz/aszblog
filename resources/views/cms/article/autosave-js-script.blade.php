<script>
    document.addEventListener('DOMContentLoaded', function () {
        let autosaveTimer = setInterval(() => {
            const editorInstance = tinymce.get('editor');
            if (!editorInstance) {
                console.warn('TinyMCE not ready yet');
                return;
            }

            const content = editorInstance.getContent();
            const articleUuidInput = document.getElementById('article_uuid');
            const article_uuid = articleUuidInput ? articleUuidInput.value : null;
            const csrf = '{{ csrf_token() }}';

            fetch('{{ route('article.draft.autosave') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    content: content,
                    article_uuid: article_uuid
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Autosaved at: ' + data.saved_at);
                })
                .catch(error => {
                    console.error('Autosave error:', error);
                });

        }, 5000);
    });
</script>
