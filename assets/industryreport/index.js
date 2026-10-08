$(document).ready(function() {
    $('.progress-circle').each(function() {
        var $circle = $(this);
        var $text = $circle.find('.progress-text');
        var progress = $circle.data('progress');
        var currentProgress = 0;
        
        var interval = setInterval(function() {
            if (currentProgress <= progress) {
                $text.text(currentProgress + '%');
                $circle.css('background', `conic-gradient(#4caf50 ${currentProgress * 3.6}deg, #ddd ${currentProgress * 3.6}deg)`);
                currentProgress++;
            } else {
                clearInterval(interval);
            }
        }, 20);
    });
});

$(document).ready(function() {
    $('.progress-circlered').each(function() {
        var $circle = $(this);
        var $text = $circle.find('.progress-text');
        var progress = $circle.data('progress');
        var currentProgress = 0;
        
        var interval = setInterval(function() {
            if (currentProgress <= progress) {
                $text.text(currentProgress + '%');
                $circle.css('background', `conic-gradient(#eb5c5c ${currentProgress * 3.6}deg, #ddd ${currentProgress * 3.6}deg)`);
                currentProgress++;
            } else {
                clearInterval(interval);
            }
        }, 20);
    });
});


function showTabContent(contentId) {
    document.querySelectorAll('.inner-tabcon').forEach(div => div.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.getElementById(contentId).classList.add('active');
    const activeTab = Array.from(document.querySelectorAll('.tab')).find(tab =>
        tab.getAttribute('onclick').includes(`showTabContent('${contentId}')`)
    );
    if (activeTab) activeTab.classList.add('active');
    activateFirstNestedTab(contentId);
}

function showNestedTabContent(nestedContentId) {
    document.querySelectorAll('.inner-nested-tabcon').forEach(content => content.classList.remove('active'));
    document.getElementById(nestedContentId).classList.add('active');
    document.querySelectorAll('.nested-tab').forEach(tab => tab.classList.remove('active'));
    const clickedNestedTab = Array.from(document.querySelectorAll('.nested-tab')).find(tab =>
        tab.getAttribute('onclick').includes(`showNestedTabContent('${nestedContentId}')`)
    );
    if (clickedNestedTab) clickedNestedTab.classList.add('active');
}

function activateFirstNestedTab(contentId) {
    const contentElement = document.getElementById(contentId);
    if (!contentElement) return;
    
    const firstNestedTab = contentElement.querySelector('.nested-tab');
    if (firstNestedTab) {
        const firstNestedContentId = firstNestedTab.getAttribute('onclick').match(/showNestedTabContent\('([^']+)'\)/)[1];
        if (firstNestedContentId) showNestedTabContent(firstNestedContentId);
    }
}


document.querySelectorAll('#closeAllTabs').forEach(button => {
    button.addEventListener('click', function() {
        const parentTab = button.closest('.inner-tabcon');

        // Remove active class from all tab elements within the same tabs container
        parentTab.closest('.tab-content').previousElementSibling.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));

        // Remove active class from all inner-tabcon elements within the same tab-content
        parentTab.closest('.tab-content').querySelectorAll('.inner-tabcon').forEach(content => content.classList.remove('active'));

        // Remove active class from all nested-tab elements within the parent inner-tabcon
        parentTab.querySelectorAll('.nested-tab').forEach(tab => tab.classList.remove('active'));

        // Remove active class from all inner-nested-tabcon elements within the parent inner-tabcon
        parentTab.querySelectorAll('.inner-nested-tabcon').forEach(content => content.classList.remove('active'));
    });
});






$(document).ready(function() {
    $(".Click-here").on('click', function() {
        var targetModal = $(this).data('target');
        $('.custom-model-main').removeClass('model-open');
        $('#' + targetModal).addClass('model-open'); 
    });

    $(document).on('click', '.close-btn, .bg-overlay', function() {
        $(this).closest('.custom-model-main').removeClass('model-open');
    });
});
