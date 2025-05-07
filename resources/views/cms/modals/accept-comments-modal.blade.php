<div id="acceptModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-round-large">
        <header class="w3-container w3-blue w3-round-large">
            <h4 id="acceptModalTitle">Akcja komentarza</h4>
        </header>
        <div class="w3-container">
            <p id="acceptModalMessage">Czy na pewno chcesz zmienić status komentarza?</p>
        </div>
        <footer class="w3-container w3-padding">
            <form id="acceptForm" method="POST" action="">
                @csrf
                <button type="submit" class="btn btn-primary btn-custom">{{ __('comments.confirm_action') }}</button>
                <button type="button" onclick="document.getElementById('acceptModal').style.display='none'" class="btn btn-light btn-custom">{{ __('article.article_action.cancel') }}</button>
            </form>
        </footer>
    </div>
</div>

<script>
    function openAcceptModal(commentId, accept) {
        const modal = document.getElementById('acceptModal');
        const form = document.getElementById('acceptForm');
        const title = document.getElementById('acceptModalTitle');
        const message = document.getElementById('acceptModalMessage');

        title.innerText = accept ? 'Zaakceptować komentarz?' : 'Wycofać akceptację?';
        message.innerText = accept
            ? 'Czy na pewno chcesz zaakceptować ten komentarz?'
            : 'Czy na pewno chcesz wycofać akceptację tego komentarza?';

        form.action = `/comment-accept/${commentId}?accept=${accept ? 1 : 0}`;
        modal.style.display = 'block';
    }
</script>

