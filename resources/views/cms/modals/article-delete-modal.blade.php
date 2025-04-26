<div id="deleteModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-red">
            <h4>{{ __('article.article_action.confirm-delete-title') }}</h4>
        </header>
        <div class="w3-container">
            <p>{{ __('article.article_action.confirm-delete-message') }}</p>
        </div>
        <footer class="w3-container w3-padding">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="w3-button w3-red">{{ __('article.article_action.confirm') }}</button>
                <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" class="w3-button w3-light-grey">{{ __('article.article_action.cancel') }}</button>
            </form>
        </footer>
    </div>
</div>
