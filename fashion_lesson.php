<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fashion Coding Lesson</title>

  <!-- CodeMirror -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/mode/python/python.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/theme/material-darker.min.css" />
  
  <!-- Pyodide -->
  <script src="https://cdn.jsdelivr.net/pyodide/v0.21.3/full/pyodide.js"></script>

  <style>
    body {
      font-family: 'Arial Black', Arial, sans-serif;
      background-color: #0d0d0d;
      color: white;
      padding: 20px;
      max-width: 1000px;
      margin: auto;
    }
    .instructions {
      background: #1a1a1a;
      border: 1px solid #333;
      padding: 20px;
      border-radius: 10px;
      margin: 20px 0;
    }
    .CodeMirror { height: 300px; font-size: 15px; background: #0d0d0d; color: white; }
    button {
      padding: 10px 20px;
      font-size: 16px;
      margin-top: 10px;
      margin-right: 10px;
      cursor: pointer;
      background-color: #4ea8de;
      color: #0d0d0d;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    button:hover { background-color: #3a86c3; }
    pre { margin-top: 20px; background: #121212; padding: 10px; border: 1px solid #555; white-space: pre-wrap; color: white; }
    .tooltip { position: relative; display: inline-block; }
    .tooltip .tooltiptext {
      visibility: hidden;
      width: 250px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 14px;
    }
    .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }

    /* Fashion gallery */
    .fashion-gallery {
      margin-top: 60px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }
    .fashion-item {
      background: #1a1a1a;
      padding: 15px;
      border-radius: 10px;
      border: 1px solid #333;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      width: 180px;
    }
    .fashion-item img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }
    .fashion-item:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .fashion-item p {
      margin-top: 10px;
      color: #ccc;
      font-size: 14px;
    }
  </style>
</head>

<body>
<form action="index.php" method="get" style="text-align: left;">
  <button type="submit" class="home-btn">Home</button>
</form>
<div class="instructions">
  <h2>Fashion Packing Challenge</h2>
  <h3>Difficulty: Easy</h3>
  <p>You are packing fashionable clothes for a vacation, but you only have space to pack 3 shirts and 4 pants! Your job is to do this using while loops. You can look below for some insiration on outfits.</p>
  <ul>
    <li>Use a <code>for</code> loop to print each shirt you're packing.</li>
    <li>Use a <code>while</code> loop to pack pants until you have 4 pants packed.</li>
  </ul>
</div>

<textarea id="code">
# Starter Code (with blanks to fill in)
def pack_suitcase():
    shirts = ["red shirt", "blue shirt", "white shirt"]
    pants = ["jeans", "black pants", "white pants", "navy pants"]

    # Pack shirts
    for _____ in _____:   # Hint: for shirt in shirts
        print("Packed:", _____)   # Hint: print shirt

    # Pack pants
    index = 0
    while _____:   # Hint: index < 4
        print("Packed:", _____)   # Hint: pants[index]
        index += 1

pack_suitcase()
</textarea>

<button onclick="runUserCode()">Run Code</button>

<div class="tooltip">
  <button onclick="runCodeWithTests()">Run Tests</button>
  <div class="tooltiptext">
    The tests check if you packed 3 shirts (for loop) and 4 pants (while loop) correctly!
  </div>
</div>

<pre id="output">(no output)</pre>

<!-- Fashion Gallery Section -->
<h2 style="text-align:center; margin-top:60px;">Inspiration</h2>

<div class="fashion-gallery">
  <div class="fashion-item">
    <img src="https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8b3V0Zml0fGVufDB8fDB8fHww" alt="Shirt">
    <p>Spring in Southern Europe</p>
  </div>
  <div class="fashion-item">
    <img src="https://images.unsplash.com/photo-1516762689617-e1cffcef479d?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8b3V0Zml0fGVufDB8fDB8fHww" alt="Jeans">
    <p>Fall in North America</p>
  </div>
  <div class="fashion-item">
    <img src="https://plus.unsplash.com/premium_photo-1734415282706-b49290018ddd?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8b3V0Zml0JTIwcGFydHl8ZW58MHx8MHx8fDA%3D" alt="Jacket">
    <p>Night Out in Central America</p>
  </div>
  <div class="fashion-item">
    <img src="https://images.unsplash.com/photo-1624281043172-16ff234c2a14?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8YmVhY2glMjBjbG90aGVzfGVufDB8fDB8fHww" alt="Backpack">
    <p>Beach Day in Bali</p>
  </div>
</div>

<script>
let pyodideReady = false;
let editor;

async function loadPyodideAndPackages() {
  window.pyodide = await loadPyodide();
  pyodideReady = true;
}
loadPyodideAndPackages();

window.addEventListener("DOMContentLoaded", () => {
  editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    mode: "python",
    lineNumbers: true,
    theme: "material-darker",
    indentUnit: 4,
    matchBrackets: true,
    styleActiveLine: true,
  });
});

async function setupPyodideOutput() {
  await pyodide.runPythonAsync(`
import sys
from io import StringIO
sys.stdout = sys.stderr = StringIO()
`);
}

async function getPyodideOutput() {
  return await pyodide.runPythonAsync("sys.stdout.getvalue()");
}

async function runUserCode() {
  const output = document.getElementById("output");
  if (!pyodideReady) {
    output.textContent = "⏳ Pyodide is still loading...";
    return;
  }

  const userCode = editor.getValue();
  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(userCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

async function runCodeWithTests() {
  const output = document.getElementById("output");
  if (!pyodideReady) {
    output.textContent = "⏳ Pyodide is still loading...";
    return;
  }

  const userCode = editor.getValue();
  const fullTestCode = `
${userCode}

# TEST CASES
output = sys.stdout.getvalue()
passed = True

expected_shirts = ["red shirt", "blue shirt", "white shirt"]
expected_pants = ["jeans", "black pants", "white pants", "navy pants"]

# Check shirts
for shirt in expected_shirts:
    if f"Packed: {shirt}" not in output:
        passed = False

# Check pants
for pant in expected_pants:
    if f"Packed: {pant}" not in output:
        passed = False

if passed:
    print("🎉 All tests passed!")
else:
    print("❌ Some tests failed. Check your loops carefully.")
`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(fullTestCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";

    if (result.includes("🎉 All tests passed!")) {
      fetch('./api/update_points.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ lesson: 'fashion' }) // <-- fashion lesson
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message); // Show success message
      })
      .catch(error => {
        alert('Error updating points: ' + error);
      });
    }
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

</script>

</body>
</html>
