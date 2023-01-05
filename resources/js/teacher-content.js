buttons = document.getElementsByClassName('btn btn-link');
[...buttons].forEach(function(button){
    button.addEventListener('click', function(e){
        e.preventDefault();
    });
});

let expandables = document.getElementsByClassName('expandable');
[...expandables].forEach(function(exp) {
    exp.addEventListener('click', function(){
        let selector = this.id;
        let toBeExpanded = document.getElementsByClassName(selector);
        [...toBeExpanded].forEach(function (element){
            if (element.classList.contains('hidden')){
                element.classList.remove('hidden');
                document.getElementById('sign-' + selector).innerHTML = '-';
            } else {
                element.classList.add('hidden');
                document.getElementById('sign-' + selector).innerHTML = '+';
            }
        });
    });
});

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    const modals = document.getElementsByClassName('modal');
    [...modals].forEach((modal) => {
        modal.style.display = "none";
        hideArrows();
    });
}

// When the user clicks anywhere outside the modal, close it
window.onclick = function(event) {
    const modals = document.getElementsByClassName('modal');
    [...modals].forEach((modal) => {
        if (event.target === modal) {
            modal.style.display = "none";
            hideArrows();
        }
    });
}

let cards = document.getElementsByClassName('sequence-card');
[...cards].forEach((card) => {
    card.addEventListener('click', function() {
        toggleChange(this);
    });
});

function selectOne(el){
    // select element
    let borderClass = [...el.classList].find(function(x) { return x !== 'sequence-card'; });
    const bgClass = borderClass + '-filled';
    el.classList.add(bgClass);
    // show content
    showContent(el);
    return bgClass;
}

function showContent(el){
    const lsContentBlocks = document.getElementsByClassName('ls-content');
    [...lsContentBlocks].forEach((block) => {
        if (block.id !== el.id + '-content'){
            if (!block.classList.contains('hidden')) {
                block.classList.add('hidden');
            }
        } else {
            if (block.classList.contains('hidden')) {
                block.classList.remove('hidden');

                let tabContainers = block.getElementsByClassName('modal_tab_container');

                if (tabContainers.length > 0){
                    let input = tabContainers[0].getElementsByTagName('input')[0];
                    input.checked = true;
                }
            }
        }
    });

    const openingBlock = document.getElementById(el.id + '-content');
    if (openingBlock.classList.contains('exercises')){
        openingBlock.parentElement.classList.remove('hidden');
    } else {
        document.getElementById('exercises-content').classList.add('hidden');
    }
}

function unselectOthers(el, bgClass){
    const toUnselect = [...cards].filter(function(x) { return x.id !== el.id && x.classList.length > 2; });
    [...toUnselect].forEach((card) => {
        let bgClass = [...card.classList].filter(function(x) { return x !== 'sequence-card'; })[1];
        card.classList.toggle(bgClass);
    });
}

// Get the button that opens the modal
let btns = document.getElementsByClassName('modalBtn');
[...btns].forEach((btn) => {
    btn.onclick = function() {
        let modalId = this.dataset.modalId;
        let theoryBtn = document.querySelector('[data-theory="theory-sc-' + modalId + '"]');
        hideGoalGrade();
        toggleChange(theoryBtn);
        let modal = document.getElementById("myModal-" + modalId);
        modal.style.display = "block";
    }
});

let changeInProgress = false;
function toggleChange(el){
    if (!changeInProgress){
        changeInProgress = true;
        const bgClass = selectOne(el);
        unselectOthers(el, bgClass);
        changeInProgress = false;
    }
}

const switches = document.getElementsByClassName('switch');

[...switches].forEach((sw) => {
    sw.querySelector('input').addEventListener('click', function(){
        const swId = sw.dataset.switch;
        const swPId = sw.dataset.parentSwitch;

        setVisibility(swId, classId,this.checked * this.checked);
        // selectChildren(swId);
        // selectParent(swPId);
    });
});

const reviewSwitches = document.getElementsByClassName('switch-review');

[...reviewSwitches].forEach((sw) => {
    sw.querySelector('span').addEventListener('click', function(){
        const swId = sw.dataset.switchReview;
        const swPId = sw.dataset.parentSwitch;

        let checked = Number(!Boolean(Number(this.dataset.reviewable)));
        setReviewable(swId, classId, checked);
        // selectChildren(swId);
        // selectParent(swPId);
    });
});

function selectChildren(swId){
    let children = document.querySelectorAll('[data-parent-switch="' + swId + '"]');
    [...children].forEach((sw) => {
        setTimeout(() => {
            let parent = document.querySelector('[data-switch="' + swId + '"]');
            let parentInput = parent.querySelector('input');

            let input = sw.querySelector('input');
            input.checked = parentInput.checked && Number(sw.dataset.ogswitch);
            selectChildren(sw.dataset.switch);
        }, 100);
    });
}

function selectParent(swPId){
    let state;

    let children = document.querySelectorAll('[data-parent-switch="' + swPId + '"]');
    [...children].forEach((sw) => {
        state ||= sw.querySelector('input').checked;
    });

    let parent = document.querySelector('[data-switch="' + swPId + '"]');
    if (parent){
        parent.querySelector('input').checked = state;
        if (parent.dataset.parentSwitch){
            selectParent(parent.dataset.parentSwitch);
        }
    }
}

function setReviewable(swId, classId, reviewable){
    const dataObj = {
        class_id: classId,
        model: swId.split("-")[0],
        model_id: swId.split("-")[1],
        reviewable
    };

    $.ajax({
        url: reviewableUrl,
        type: 'POST',
        data: dataObj,
        success: function(){
            const sw = document.querySelectorAll('[data-switch-review="' + swId + '"]');
            [...sw].forEach((sw) => {
                let span = sw.querySelector('span');
                if (span){
                    span.dataset.reviewable = reviewable
                    let img = span.querySelector('img');
                    if (img){
                        img.src = '/icons/review-' + reviewable + '.svg'
                    }
                }
            })
        },
        error: function(result) {
            new Noty({
                type: "warning",
                text: "<strong>Updating failed</strong><br>Please try again."
            }).show();
        }
    });
}
function setVisibility(swId, classId, visibility){
    const dataObj = {
        class_id: classId,
        model: swId.split("-")[0],
        model_id: swId.split("-")[1],
        visibility
    };

    $.ajax({
        url: visibilityUrl,
        type: 'POST',
        data: dataObj,
        success: function(){
            const sw = document.querySelectorAll('[data-switch="' + swId + '"]');
            [...sw].forEach((sw) => {
                sw.ogswitch = visibility;

                if (sw.classList.contains('eye')){
                    if (visibility){
                        sw.classList.add('eye-on')
                        sw.closest('.bordered').classList.remove('bordered-not-visible')
                    } else {
                        sw.classList.remove('eye-on')
                        sw.closest('.bordered').classList.add('bordered-not-visible')
                    }
                }

                if (sw.dataset.lsBox){
                    const lsBox = document.querySelector('#' + sw.dataset.lsBox)
                    if (visibility){
                        lsBox.classList.add('bi-square-fill');
                    } else {
                        lsBox.classList.remove('bi-square-fill');
                    }
                }

                let input = sw.querySelector('input');
                if (input){
                    input.checked = visibility;
                }
            })
        },
        error: function(result) {
            new Noty({
                type: "warning",
                text: "<strong>Updating failed</strong><br>Please try again."
            }).show();
        }
    });
}

// modal js
function showArrows(sequence_id, controller_function = null, args = null){
    let arrows = document.getElementById('control_arrows-' + sequence_id);
    arrows.style.display = 'flex';

    let pageNumbers = [0,0];
    if (controller_function){
        arrows.addEventListener('click', (e) => {
            controller_function(sequence_id, e, args)
        })
        pageNumbers = controller_function(sequence_id, null, args);
    }

    return pageNumbers;
}

function hideArrows(){
    let arrowsList = document.getElementsByClassName('control-arrows');
    [...arrowsList].forEach((arrows) => {
        arrows.style.display = 'none';
        arrows.replaceWith(arrows.cloneNode(true));
    })
}

function getDirection(e = null){
    if (e && e.target.dataset.direction){
        return e.target.dataset.direction;
    }

    return null;
}

function transformIndex(len = 0, i = 0){
    if (i >= len){
        i = i % len;
    }

    if (i < 0){
        while (i < 0){
            i += len;
        }
    }

    return i;
}

function followUpController(sequence_id, e = null){
    const direction = getDirection(e);

    const parentBlock = document.querySelector("[data-follow-up-id='follow-up-sc-content-" + sequence_id + "']");
    const nodes = parentBlock.getElementsByClassName('follow-up-question');
    const activeNode = [...nodes].find((n) => !n.classList.contains('hidden'));
    let newIndex = 0;

    if (direction == 'prev'){
        activeNode.classList.add('hidden');
        newIndex = transformIndex(nodes.length, Number(activeNode.dataset.index) - 1);
        nodes[newIndex].classList.remove('hidden');
        showPageNumbers(sequence_id, newIndex + 1, nodes.length);
    } else if (direction == 'next') {
        activeNode.classList.add('hidden');
        newIndex = transformIndex(nodes.length, Number(activeNode.dataset.index) + 1);
        nodes[newIndex].classList.remove('hidden');
        showPageNumbers(sequence_id, newIndex + 1, nodes.length);
    }

    return [newIndex + 1, nodes.length];
}

function exerciseController(sequence_id, e = null, args = null){
    let direction = getDirection(e);

    let selector = null;

    if (args && args.exercise_id){
        selector = document.getElementById(`exercise-${args.exercise_id}-sc-content`)
    } else {
        selector = document.getElementsByClassName('exercises')[0]
    }

    const parentBlock = selector;
    const goalGradeString = parentBlock.dataset.goalGrade;
    showGoalGrade(goalGradeString);

    const gradePointsString = parentBlock.dataset.gradePoints;
    showGradePoints(gradePointsString);

    const nodes = parentBlock.getElementsByClassName('modal_tab_container');
    const activeNode = [...nodes].find((n) => !n.classList.contains('hidden'));
    let newIndex = 0;
    let modalState = 0;

    if (activeNode){
        activeNode.querySelectorAll('input').forEach((input, index) => {
            if (input.checked){
                modalState = index;
            }
        });

        if (direction == 'prev'){
            activeNode.classList.add('hidden');
            newIndex = transformIndex(nodes.length, Number(activeNode.dataset.index) - 1);
            nodes[newIndex].classList.remove('hidden');
            nodes[newIndex].getElementsByTagName('input')[modalState].checked = true;

            showPageNumbers(sequence_id, newIndex + 1, nodes.length);
        } else if (direction == 'next') {
            activeNode.classList.add('hidden');
            newIndex = transformIndex(nodes.length, Number(activeNode.dataset.index) + 1);
            nodes[newIndex].classList.remove('hidden');
            nodes[newIndex].getElementsByTagName('input')[modalState].checked = true;

            showPageNumbers(sequence_id, newIndex + 1, nodes.length);
        }
    }

    return [newIndex + 1, nodes.length];
}

function initFollowup(sequence_id){
    hideArrows();
    hidePageNumbers();
    hideGoalGrade();
    hideGradePoints();
    let pageNumbers = showArrows(sequence_id, followUpController);
    document.querySelectorAll(".follow-up-question").forEach((q, index) => {
        if (!index) q.classList.remove('hidden');
        else q.classList.add('hidden')
    });
    showPageNumbers(sequence_id, pageNumbers[0], pageNumbers[1]);
}

function initExercises(exercise_id, sequence_id){
    hideArrows();
    hidePageNumbers();
    hideGoalGrade();
    hideGradePoints();
    let pageNumbers = showArrows(sequence_id, exerciseController, {'exercise_id': exercise_id});
    showPageNumbers(sequence_id, pageNumbers[0], pageNumbers[1]);
}

function showPageNumbers(sequence_id, indexNum = 0, outOfNum = 0){
    const pageNumbers = document.getElementById('page-numbers-' + sequence_id);
    pageNumbers.classList.remove('hidden');

    const index = pageNumbers.getElementsByClassName('index')[0];
    const outOf = pageNumbers.getElementsByClassName('out-of')[0];

    index.innerHTML = Math.min(indexNum, outOfNum);
    outOf.innerHTML = outOfNum;
}

function hidePageNumbers(){
    const pageNumbers = document.getElementsByClassName('page-numbers');
    [...pageNumbers].forEach((pageNumber) => {
        pageNumber.classList.add('hidden');
    })
}

function hideGoalGrade(){
    const goalGrades = document.getElementsByClassName('goal-grade');
    [...goalGrades].forEach((goalGrade) => {
        goalGrade.classList.add('hidden');
    })
}

function hideGradePoints(){
    const gradePointsArray = document.getElementsByClassName('grade-points');
    [...gradePointsArray].forEach((gradePointsElement) => {
        gradePointsElement.classList.add('hidden');
    })
}

function showGoalGrade(goalGradeString = ''){
    document.getElementsByClassName('goal-grade')[0].innerHTML = "Goal Grade: " + goalGradeString;
    document.getElementsByClassName('goal-grade')[0].classList.remove('hidden');
}

function showGradePoints(gradePointsString = ''){
    document.getElementsByClassName('grade-points')[0].innerHTML = "Grade Points: " + gradePointsString;
    document.getElementsByClassName('grade-points')[0].classList.remove('hidden');
}
