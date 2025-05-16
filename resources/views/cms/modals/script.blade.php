
<script>
    function openDeleteModal(url) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = url;
        modal.style.display = 'block';
    }

    // publish modal
    let currentArticleId = null;
    function openStatusModal(articleId) {
        currentArticleId = articleId;
        document.getElementById('modal-article-id').innerText = 'Artykuł ID: ' + articleId;
        document.getElementById('statusModal').style.display = 'block';
    }

    function closeStatusModal() {
        document.getElementById('statusModal').style.display = 'none';
    }

    function submitStatusChange(newStatus) {
        fetch("{{ route('article.update.published') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                article_id: currentArticleId,
                new_status: newStatus
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Błąd podczas aktualizacji statusu');
                }
                return response.json();
            })
            .then(data => {
                console.log('Sukces:', data);
                closeStatusModal();
                location.reload(); // odśwież stronę po zmianie
            })
            .catch(error => {
                alert('Wystąpił błąd: ' + error.message);
                console.error(error);
            });
    }
</script>
