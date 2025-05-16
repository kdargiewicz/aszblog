<div id="statusModal" class="w3-modal" style="z-index: 9999;">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="max-width: 400px;">
        <header class="w3-container w3-teal">
            <span onclick="closeStatusModal()" class="w3-button w3-display-topright">&times;</span>
            <h3>{{ __('article.article_action.change-publish-status') }}</h3>
        </header>
        <div class="w3-container w3-padding">
            <p id="modal-article-id" class="w3-small w3-text-grey"></p>
            <button class="w3-button w3-block w3-red w3-margin-bottom" onclick="submitStatusChange({{ \App\Constants\Constants::NOT_PUBLISHED }})">{{ __('article.article_action.not-published') }}</button>
            <button class="w3-button w3-block w3-yellow w3-margin-bottom" onclick="submitStatusChange({{ \App\Constants\Constants::TEST_PUBLISHED }})">{{ __('article.article_action.test-published') }}</button>
            <button class="w3-button w3-block w3-green" onclick="submitStatusChange({{ \App\Constants\Constants::PUBLISHED }})">{{ __('article.article_action.published') }}</button>
        </div>
    </div>
</div>
