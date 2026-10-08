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
    document.querySelectorAll('.inner-tabcon').forEach(div => {
        div.classList.remove('active');
    });

    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });

    document.getElementById(contentId).classList.add('active');
    var activeTab = Array.from(document.querySelectorAll('.tab')).find(tab => 
        tab.getAttribute('onclick').includes(`showTabContent('${contentId}')`)
    );
    if (activeTab) {
        activeTab.classList.add('active');
    }
    activateFirstNestedTab(contentId);
}

function showNestedTabContent(nestedContentId) {
    document.querySelectorAll('.inner-nested-tabcon').forEach(content => {
        content.classList.remove('active');
    });

    const selectedNestedContent = document.getElementById(nestedContentId);
    selectedNestedContent.classList.add('active');

    document.querySelectorAll('.nested-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    const clickedNestedTab = Array.from(document.querySelectorAll('.nested-tab')).find(tab => 
        tab.getAttribute('onclick').includes(`showNestedTabContent('${nestedContentId}')`)
    );
    if (clickedNestedTab) {
        clickedNestedTab.classList.add('active');
    }
}

function activateFirstNestedTab(contentId) {
    const contentElement = document.getElementById(contentId);
    if (!contentElement) return;

    const firstNestedTab = contentElement.querySelector('.nested-tab');
    if (firstNestedTab) {
        const firstNestedContentId = firstNestedTab.getAttribute('data-nested-content');
        if (firstNestedContentId) {
            showNestedTabContent(firstNestedContentId);
        }
    }
}


document.getElementById('closeAllTabs').addEventListener('click', function() {
    // Deactivate all tabs
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });

    document.querySelectorAll('.inner-tabcon').forEach(content => {
        content.classList.remove('active');
    });

    // // Optionally, reactivate the default tab and content
    // // For example, if 'Create Alliances' is the default:
    // document.querySelector('.tab').classList.add('active');
    // document.getElementById('content21').classList.add('active');

    // // Activate the first nested tab and its content by default
    // activateFirstNestedTab('content21');
});
