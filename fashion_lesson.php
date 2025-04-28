<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fashion Coding Lesson</title>

  <!-- CodeMirror core -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.js"></script>

  <!-- Python syntax mode -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/mode/python/python.min.js"></script>

  <!-- Optional theme (dark mode) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/theme/material-darker.min.css" />

  <!-- Pyodide -->
  <script src="https://cdn.jsdelivr.net/pyodide/v0.21.3/full/pyodide.js"></script>

  <form action="index.php" method="get" style="display: inline-block;">
    <button type="submit" class="home-btn">Home</button>
  </form>

  <style>
    body {
      font-family: 'Arial Black', Arial, sans-serif;
      background-color: #0d0d0d;
      color: white;
      padding: 20px;
      max-width: 900px;
      margin: auto;
    }

    .instructions {
      background-color: #1a1a1a;
      border: 1px solid #333;
      padding: 20px;
      margin-top: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .CodeMirror {
      height: 300px;
      font-size: 15px;
      background-color: #0d0d0d;
      color: white;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
      background-color: #4ea8de;
      color: #0d0d0d;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #3a86c3;
    }

    pre {
      margin-top: 20px;
      background: #121212;
      padding: 10px;
      border: 1px solid #555;
      white-space: pre-wrap;
      color: white;
    }

    /* Tooltip container */
    .tooltip {
      position: relative;
      display: inline-block;
    }

    /* Tooltip text */
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
      bottom: 125%; /* Position above the button */
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

    h2 {
      font-weight: bold;
    }
  </style>
</head>

<body>

<div class="instructions">
  <h2>Fashion Packing Challenge</h2>
  <p>
    You are packing clothes for a fashion event. You must pack 3 shirts and 4 pairs of pants using loops!
  </p>
  <p><strong>Instructions:</strong></p>
  <ul>
    <li>Use a <code>for</code> loop to print each shirt you're packing.</li>
    <li>Use a <code>while</code> loop to pack pants until you have 4 pants packed.</li>
  </ul>
  <p>Start typing your solution below and then click "Run Code" or "Run Tests" to see if you got it right!</p>
</div>

<textarea id="code">
# Starter Code (with blanks to fill in)
def pack_suitcase():
    shirts = ["red shirt", "blue shirt", "white shirt"]
    pants = ["jeans", "black pants", "white pants", "navy pants"]

    # Pack shirts using a for loop
    # LOOP through each shirt in the list
    for _____ in _____:   # Hint: for shirt in shirts
        print("Packed:", _____)   # Hint: print the shirt

    # Pack pants using a while loop
    # Keep packing pants while packed < 4
    packed = 0
    index = 0
    while _____:    # Hint: packed < 4
        print("Packed:", _____)   # Hint: print pants[index]
        packed += 1
        index += 1

pack_suitcase()
</textarea>

<br>

<button onclick="runUserCode()">Run Code</button>

<div class="tooltip">
  <button onclick="runCodeWithTests()">Run Tests</button>
  <div class="tooltiptext">
    The tests will check if you packed 3 shirts using a for loop and 4 pants using a while loop!
  </div>
</div>

<pre id="output">(no output)</pre>

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
    indentUnit: 4,
    tabSize: 4,
    matchBrackets: true,
    theme: "material-darker",
    styleActiveLine: true,
    autofocus: true,
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
  const testCode = `
shirts = ["red", "blue", "white"]
pants = []

# Students code
${userCode}

# Testing Section
passed = True

if "Packing shirt: red" not in sys.stdout.getvalue():
    passed = False
if "Packing shirt: blue" not in sys.stdout.getvalue():
    passed = False
if "Packing shirt: white" not in sys.stdout.getvalue():
    passed = False
if sys.stdout.getvalue().count("Packing pants") != 4:
    passed = False

if passed:
    print("🎉 All tests passed!")
else:
    print("❌ Some tests failed. Check your loops carefully!")
`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(testCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}
</script>

</body>
</html>
