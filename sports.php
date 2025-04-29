<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Basketball Coding Challenge</title>

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
      background-color: #1a1a1a;
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
    pre {
      margin-top: 20px;
      background: #121212;
      padding: 10px;
      border: 1px solid #555;
      white-space: pre-wrap;
      color: white;
    }
    #lesson-2 {
      display: none;
      margin-top: 40px;
    }
  </style>
</head>

<body>

<form action="index.php" method="get" style="text-align: left;">
  <button type="submit" class="home-btn">🏠 Home</button>
</form>

<div class="instructions">
  <h2>🏀 Basketball Coding Challenge - Lesson 1</h2>
  <h3>Difficulty: Hard</h3>
  <p>Write a function <code>calculateAverage(scores)</code> that returns the average score given a list of numbers.</p>
  <p><strong>Example:</strong> <code>[23, 31, 19, 45]</code> → <code>29.5</code></p>
</div>

<textarea id="code">
# Starter Code (fill in the blanks)
def calculateAverage(scores: list) -> float:
    # Hint: Add up all the scores
    # Hint: Divide by how many scores there are
    pass

# Example use
print("Average:", calculateAverage([1, 2, 3]))
</textarea>

<button onclick="runUserCode()">▶️ Run Code</button>
<button onclick="runCodeWithTests()">🧪 Run Tests</button>

<pre id="output">(no output)</pre>

<div id="lesson-2">
  <div class="instructions">
    <h2>🏀 Advanced Basketball Challenge - Lesson 2</h2>
    <p>Write a function <code>calculateAverages(games)</code> that takes a list of games and returns a list of average scores for each game.</p>
    <p><strong>Example:</strong></p>
    <pre>
[[23, 31, 19, 45], [12, 15, 20]] → [29.5, 15.6666]
    </pre>
  </div>

  <textarea id="lesson2-editor">
# Starter Code
def calculateAverages(games: list) -> list:
    # Hint: Use a for loop to go through each game!
    pass

# Example use
print(calculateAverages([[23, 31, 19, 45], [12, 15, 20]]))
</textarea>

  <button onclick="runLesson2Code()">▶️ Run Code (Lesson 2)</button>
  <button onclick="runLesson2Tests()">🧪 Run Tests (Lesson 2)</button>

  <pre id="output-lesson2">(no output)</pre>
</div>

<script>
let pyodideReady = false;
let editor;
let editor2;

async function loadPyodideAndPackages() {
  window.pyodide = await loadPyodide();
  pyodideReady = true;
}
loadPyodideAndPackages();

window.addEventListener("DOMContentLoaded", () => {
  editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    mode: "python",
    theme: "material-darker",
    lineNumbers: true,
    indentUnit: 4,
    matchBrackets: true,
    styleActiveLine: true,
  });
});

// Setup Pyodide output
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

// Run User Code (Lesson 1)
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

// Run Tests (Lesson 1)
async function runCodeWithTests() {
  const output = document.getElementById("output");
  if (!pyodideReady) return;

  const userCode = editor.getValue();
  const fullTestCode = `
${userCode}

# Test cases for Lesson 1
print("\\nRunning Hidden Tests...")
passed = True

try:
    if round(calculateAverage([1,2,3]), 5) != 2:
        passed = False
    if round(calculateAverage([10,20]), 5) != 15:
        passed = False
    if round(calculateAverage([1,2,3,4]), 5) != 2.5:
        passed = False
    if round(calculateAverage([100]), 5) != 100:
        passed = False
    if round(calculateAverage([0,0,0]), 5) != 0:
        passed = False
except:
    passed = False

if passed:
    print("🎉 All tests passed!")
else:
    print("❌ Some tests failed. Check your code carefully.")
`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(fullTestCode);
    const result = await getPyodideOutput();
    output.textContent = result;

    if (result.includes("🎉 All tests passed!")) {
      unlockLesson2();
      updatePoints('sports1'); // 🚀 Update points after passing lesson 1
    }
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

// Unlock Lesson 2
function unlockLesson2() {
  if (!editor2) {
    editor2 = CodeMirror.fromTextArea(document.getElementById("lesson2-editor"), {
      mode: "python",
      theme: "material-darker",
      lineNumbers: true,
      indentUnit: 4,
      matchBrackets: true,
      styleActiveLine: true,
    });
    editor2.refresh();
  }
  document.getElementById("lesson-2").style.display = "block";
  window.scrollTo({ top: document.getElementById("lesson-2").offsetTop, behavior: 'smooth' });
}

// Run Code (Lesson 2)
async function runLesson2Code() {
  const output = document.getElementById("output-lesson2");
  if (!pyodideReady) return;
  const userCode = editor2.getValue();
  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(userCode);
    const result = await getPyodideOutput();
    output.textContent = result;
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

// Run Tests (Lesson 2)
async function runLesson2Tests() {
  const output = document.getElementById("output-lesson2");
  if (!pyodideReady) return;

  const userCode = editor2.getValue();
  const fullTestCode = `
${userCode}

# Test cases for Lesson 2
print("\\nRunning Hidden Tests...")
passed = True

try:
    res = calculateAverages([[1,2,3],[4,5,6]])
    if res != [2.0,5.0]:
        passed = False
except:
    passed = False

if passed:
    print("🎉 Passed!")
else:
    print("❌ Failed tests.")
`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(fullTestCode);
    const result = await getPyodideOutput();
    output.textContent = result;

    if (result.includes("🎉 Passed!")) {
      updatePoints('sports2'); // 🚀 Update points after passing lesson 2
    }
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

// Update Points function
function updatePoints(lessonName) {
  fetch('./api/update_points.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ lesson: lessonName })
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
  })
  .catch(error => {
    alert('Error updating points: ' + error);
  });
}
</script>

</body>
</html>
