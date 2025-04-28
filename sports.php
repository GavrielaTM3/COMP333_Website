<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Basketball Coding Lesson</title>

  <!-- CodeMirror core -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/codemirror.min.js"></script>

  <!-- Python syntax mode -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.10/mode/python/python.min.js"></script>

  <!-- Dark theme for editor -->
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
      margin-right: 10px;
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
      border-radius: 8px;
      white-space: pre-wrap;
      color: white;
    }

    h2 {
      font-size: 2em;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .home-btn {
      margin-top: 10px;
      margin-bottom: 20px;
      background-color: #4ea8de;
      color: #0d0d0d;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 16px;
      text-decoration: none;
      font-weight: bold;
    }

    .home-btn:hover {
      background-color: #3a86c3;
    }
  </style>
</head>

<body>

<form action="index.php" method="get" style="text-align: left;">
  <button type="submit" class="home-btn">🏠 Home</button>
</form>

<div class="instructions">
  <h2>🏀 Basketball Coding Challenge</h2>
  <p>You are a data analyst for a basketball team. You are given a list of player scores and you want to calculate the average number of points each player scores.</p>
  <p><strong>Your task:</strong> Write a function <code>calculateAverage(scores)</code> that takes a list of numbers and returns the average score.</p>
  <p><strong>Example:</strong>  
    If the scores are <code>[23, 31, 19, 45]</code>, the average should be <code>29.5</code>.
  </p>
  <p><strong>Instructions:</strong> Complete the function so that it calculates and returns the correct average score. Then click "Run Code" to see if your code works, and "Run Tests" to verify it passes all hidden tests!</p>
</div>

<textarea id="code"># Starter code:
def calculateAverage(scores: list) -> float:
    # Your code here

print("Average:", calculateAverage([1, 2, 3]))</textarea>

<br>

<button onclick="runUserCode()">▶️ Run Code</button>
<button onclick="runCodeWithTests()">🧪 Run Tests</button>

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
    const testSuite = `
print("\\nRunning Hidden Tests...")
passed_all_tests = True

test_cases = [
    ([1, 2, 3], 2),
    ([10, 20], 15),
    ([1, 2, 3, 4], 2.5),
    ([100], 100),
    ([0, 0, 0], 0)
]

for i, (input_data, expected) in enumerate(test_cases, 1):
    try:
        result = calculateAverage(input_data)
        if round(result, 5) == round(expected, 5):
            print(f"✅ Test {i}: Passed")
        else:
            print(f"❌ Test {i}: Failed — Expected {expected} but got {result}")
            passed_all_tests = False
    except Exception as e:
        print(f"❌ Test {i}: Error — {str(e)}")
        passed_all_tests = False

print("🎉 All tests passed!" if passed_all_tests else "❌ Some tests failed.")
`;

    const fullCode = `${userCode}\n\n${testSuite}`;

    try {
      await setupPyodideOutput();
      await pyodide.runPythonAsync(fullCode);
      const result = await getPyodideOutput();
      output.textContent = result || "(no output)";
    } catch (err) {
      output.textContent = "❌ Error:\n" + err;
    }
  }
</script>

</body>
</html>
