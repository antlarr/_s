function randomFromTo(from, to){
       return Math.floor(Math.random() * (to - from + 1) + from);
}

// search the CSSOM for a specific keyframe rule
function findKeyframesRule(rule)
    {
        // gather all stylesheets into an array
        var ss = document.styleSheets;

        // loop through the stylesheets
        for (var i = 0; i < ss.length; ++i) {
            // loop through all the rules
            for (var j = 0; j < ss[i].cssRules.length; ++j) {

                // find the -webkit-keyframe rule whose name matches our passed over parameter and return that rule
                if (ss[i].cssRules[j].type == CSSRule.KEYFRAMES_RULE && ss[i].cssRules[j].name == rule)
                    return ss[i].cssRules[j];
            }
        }

        // rule not found
        return null;
    }

// remove old keyframes and add new ones
function changeOffsets(animatedObject, keyFramesName, startPos, endPos)
{
    // find our -webkit-keyframe rule
    var keyframes = findKeyframesRule(keyFramesName);

    // remove the existing 0% and 100% rules
    keyframes.deleteRule("0%");
    keyframes.deleteRule("100%");

    keyframes.appendRule("0% { transform: translateX("+startPos+"px); }");
    keyframes.appendRule("100% { transform: translateX("+endPos+"px); }");

    animatedObject.style.animationName = keyFramesName;
}

function setupNewsTicker(containerID, scrollableID, itemsClassName, keyFramesName, speed=8)
{
    var container = document.getElementById(containerID);
    var scrollable = document.getElementById(scrollableID);
    var scrollItems = document.getElementsByClassName(itemsClassName);
    marqueeWidth = container.offsetWidth;
    paddingLeft = parseFloat(window.getComputedStyle(scrollable, null).getPropertyValue('padding-left'));
    scrollableWidth = scrollable.offsetWidth /*+ scrollable.offsetLeft */- paddingLeft;

    for (var i = 0; i < scrollItems.length; i++) {
        if (scrollItems[i].offsetLeft < marqueeWidth)
        {
            var copy = scrollItems[i].cloneNode(true);
            scrollable.appendChild(copy);
        }
    }
    changeOffsets(scrollable, keyFramesName, 0, -scrollableWidth);
    speed = (Math.min(200, Math.max(1, speed)));

    scrollable.style.animationDuration = scrollableWidth/(speed*10)+'s';
}

setupNewsTicker('newsticker-container', 'newsticker-scrollable', 'newsticker-item', 'scroll-left');
