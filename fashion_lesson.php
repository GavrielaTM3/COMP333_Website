<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fashion Coding Lesson</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f0f8ff; }
        .editor { width: 100%; height: 200px; margin-bottom: 10px; }
        .run-btn { padding: 10px 20px; font-size: 16px; background: #6e8eff; color: white; border: none; border-radius: 5px; }
        .instructions { background: #eef; padding: 15px; margin-bottom: 20px; border-left: 5px solid #7aa6d0; }
        .outfit-gallery { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px; }
        .outfit { text-align: center; border: 1px solid #ccc; border-radius: 10px; padding: 10px; background: #fff; width: 150px; }
        .outfit img { max-width: 100%; border-radius: 5px; }
        pre { white-space: pre-wrap; background: #f4f4f4; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>

<h1>👗 Fashion Coding Lesson: Outfit Matcher</h1>

<div class="instructions">
    <p>🎯 <strong>Goal:</strong> Use <code>for</code> or <code>while</code> loops to match tops and pants.</p>
    <p><strong>Rules:</strong></p>
    <ul>
        <li>👕 <strong>White top</strong> → Match with any pants</li>
        <li>👕 <strong>Blue top</strong> → Match with <em>dark pants only</em></li>
        <li>👕 <strong>Cheetah print</strong> → Match with <em>white or black pants only</em></li>
    </ul>
</div>

<textarea id="codeBox" class="editor">// Example:
let top = "pink";
let pantsOptions = ["black", "green", "white"];
for (let i = 0; i < pantsOptions.length; i++) {
    matchOutfit(top, pantsOptions[i]);
}</textarea>
<br>
<button onclick="runCode()" class="run-btn">Run Code</button>
<div id="output" class="outfit-gallery">
    <!-- Outfit images will appear here -->
</div>

<script>
const outfitImages = {
    tops: {
        white: 'https://cdn.pixabay.com/photo/2016/11/22/20/10/white-1854059_1280.jpg',
        blue: 'https://cdn.pixabay.com/photo/2013/07/12/18/22/t-shirt-153369_1280.png',
        red: 'https://cdn.pixabay.com/photo/2013/07/12/15/34/shirt-150087_1280.png',
        pink: 'https://cdn.pixabay.com/photo/2012/04/14/15/09/shirt-34238_1280.png',
        cheetah: 'https://cdn.pixabay.com/photo/2014/11/10/14/46/t-shirt-525759_1280.jpg'
    },
    pants: {
        brown: 'https://cdn.pixabay.com/photo/2016/08/20/12/41/pants-1607444_1280.png',
        black: 'https://cdn.pixabay.com/photo/2012/04/24/11/18/clothing-39389_1280.png',
        blue: 'https://cdn.pixabay.com/photo/2014/04/02/10/40/jeans-304196_1280.png',
        green: 'https://cdn.pixabay.com/photo/2017/08/10/07/32/fashion-2619790_1280.jpg',
        navy: 'https://cdn.pixabay.com/photo/2022/07/04/08/32/pants-7300321_1280.jpg',
        white: 'https://cdn.pixabay.com/photo/2016/02/01/21/09/jeans-1178914_1280.jpg',
        red: 'https://cdn.pixabay.com/photo/2014/12/21/23/28/pants-576144_1280.png'
    }
};
function matchOutfit(top, pant) {
    const outputDiv = document.getElementById('output');

    const rules = {
        white: () => true, // allow all
        blue: (p) => ["black", "navy", "brown"].includes(p),
        cheetah: (p) => ["white", "black"].includes(p)
    };

    const isValid = rules[top]
        ? rules[top](pant)
        : true; // allow all by default for tops not defined in rules

    if (!isValid) return;

    // Clear previous output on first match
    if (!window.firstMatchDone) {
        outputDiv.innerHTML = '';
        window.firstMatchDone = true;
    }

    const topImg = outfitImages.tops[top];
    const pantImg = outfitImages.pants[pant];

    const outfit = document.createElement('div');
    outfit.className = 'outfit';
    outfit.innerHTML = `
        <img src="${topImg || ''}" alt="${top} top">
        <p><strong>${top} top</strong></p>
        <img src="${pantImg || ''}" alt="${pant} pants">
        <p><strong>${pant} pants</strong></p>
    `;
    outputDiv.appendChild(outfit);
}

function runCode() {
    const userCode = document.getElementById('codeBox').value;
    window.firstMatchDone = false;

    try {
        const func = new Function('matchOutfit', userCode);
        func(matchOutfit);
    } catch (err) {
        document.getElementById('output').innerHTML = `<pre>Error: ${err.message}</pre>`;
    }
}
</script>

</body>
</html>
