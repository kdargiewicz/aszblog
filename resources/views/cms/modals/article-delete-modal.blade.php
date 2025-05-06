<div id="deleteModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-round-large">
        <header class="w3-container w3-pale-red w3-round-large">
            <h4>{{ __('article.article_action.confirm-delete-title') }}</h4>
        </header>
        <div class="w3-container">
            <p>{{ __('article.article_action.confirm-delete-message') }}</p>
        </div>
        <footer class="w3-container w3-padding">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-custom">{{ __('article.article_action.confirm') }}</button>
                <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" class="btn btn-info btn-custom">{{ __('article.article_action.cancel') }}</button>
            </form>
        </footer>
    </div>
</div>
