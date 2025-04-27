<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Python Coding Lesson</title>

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
    <button type="submit" class="home-btn">🏠 Home</button>
  </form>
  <style>
    body {
      font-family: sans-serif;
      background-color: #1e1e1e;
      color: white;
      padding: 20px;
      max-width: 900px;
      margin: auto;
    }

    .instructions {
      background-color: #2d2d2d;
      border: 1px solid #555;
      padding: 20px 20px;
      margin-bottom: 50px;       
      margin-top: 20px;  
      border-radius: 8px;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .CodeMirror {
      height: 300px;
      font-size: 15px;
      background-color: #1e1e1e;
      color: white;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      margin-right: 10px;
      margin-top: 10px;
      cursor: pointer;
    }

    pre {
      margin-top: 20px;
      background: #121212;
      padding: 10px;
      border: 1px solid #555;
      white-space: pre-wrap;
      color: white;
    }

    h2 {
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="instructions">
    <h2>🏀 Basketball Coding Challenge</h2>
    <p>
      You are a data analyst for a basketball team. You are given a list of player scores and you want to calculate the 
      average number of points the player scores. 
      Your task is to write a function <code>calculateAverage(scores)</code> that takes a list of numbers and returns the average score.
    </p>
    <p>
      For example, if the scores are <code>[23, 31, 19, 45]</code>, the average should be <code>29.5</code>.
    </p>
    <p><strong>Instructions:</strong> Complete the function so that it calculates and returns the correct average score. Click "Run Code" to run the code you have written 
  and click "Run Tests" to test your code on some hidden test cases. Your goal is write the function so it passes all test cases!</p>
  </div>
  <textarea id="code">def calculateAverage(scores: list) -> float:

print("Average:", calculateAverage([1, 2, 3]))</textarea>

  <br>
  <button onclick="runUserCode()">▶️ Run Code</button>
  <button onclick="runCodeWithTests()">🧪 Run Tests</button>

  <pre id="output">(no output)</pre>

  <script>
    let currentLesson = 1;
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
  const nextLesson = document.getElementById("next-lesson");
  const lesson2 = document.getElementById("lesson-2");
  if (!pyodideReady) {
    output.textContent = "⏳ Pyodide is still loading...";
    return;
  }

  const userCode = editor.getValue();

  let testSuite = "";

  // Decide which lesson's test cases to use
  if (currentLesson === 1) {
    testSuite = `
print("\\nRunning Hidden Tests for Lesson 1...")
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
            print(f"❌ Test {i}: Failed — Input: {input_data} | Expected: {expected} | Got: {result}")
            passed_all_tests = False
    except Exception as e:
        print(f"❌ Test {i}: Error on input {input_data} — {str(e)}")
        passed_all_tests = False

print("ALL_TESTS_PASSED" if passed_all_tests else "TESTS_FAILED")
`;
  } else if (currentLesson === 2) {
    testSuite = `
print("\\nRunning Hidden Tests for Lesson 2...")
passed_all_tests = True

test_cases = [
    ([[1, 2, 3], [4, 5, 6]], [2.0, 5.0]),
    ([[10, 20, 30], [5, 5, 5, 5]], [20.0, 5.0]),
    ([[100], [50, 50], [0, 0, 0]], [100.0, 50.0, 0.0]),
    ([[7, 8], [15, 5, 10]], [7.5, 10.0]),
    ([[23, 31, 19, 45]], [29.5])
]

for i, (input_data, expected) in enumerate(test_cases, 1):
    try:
        result = calculateAverages(input_data)
        if all(round(r, 5) == round(e, 5) for r, e in zip(result, expected)):
            print(f"✅ Test {i}: Passed")
        else:
            print(f"❌ Test {i}: Failed — Input: {input_data} | Expected: {expected} | Got: {result}")
            passed_all_tests = False
    except Exception as e:
        print(f"❌ Test {i}: Error on input {input_data} — {str(e)}")
        passed_all_tests = False

print("ALL_TESTS_PASSED" if passed_all_tests else "TESTS_FAILED")
`;
  }

  const fullCode = `${userCode}\n\n${testSuite}`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(fullCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";

    if (result.includes("ALL_TESTS_PASSED")) {
      if (currentLesson === 1) {
        nextLesson.style.display = "block";  
        
        nextLesson.scrollIntoView({ behavior: "smooth" });
      } else if (currentLesson === 2) {
        alert("🎉 Congratulations! You completed all lessons!");
      }
    }
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}

let editor2; 

function startLesson2() {
  currentLesson = 2;

  document.getElementById("lesson-2").style.display = "block";

  if (!editor2) {
    editor2 = CodeMirror.fromTextArea(document.getElementById("lesson2-editor"), {
      mode: "python",
      lineNumbers: true,
      indentUnit: 4,
      tabSize: 4,
      matchBrackets: true,
      theme: "material-darker",
      styleActiveLine: true,
      autofocus: true,
    });
  }

  editor2.setValue(`def calculateAverages(games: list) -> list:
    # Write your code here
    pass

# Example use
games = [
    [23, 31, 19, 45],
    [12, 15, 20],
    [50, 30]
]
print(calculateAverages(games))  # Expected: [29.5, 15.666666666666666, 40.0]
`);

  document.getElementById("output-lesson2").textContent = "(no output)";
  editor2.focus();
  document.getElementById("lesson-2").scrollIntoView({ behavior: "smooth" });
}
async function runLesson2Code() {
  const output = document.getElementById("output-lesson2");
  if (!pyodideReady) {
    output.textContent = "⏳ Pyodide is still loading...";
    return;
  }

  const userCode = editor2.getValue();

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(userCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}
async function runLesson2Tests() {
  const output = document.getElementById("output-lesson2");
  if (!pyodideReady) {
    output.textContent = "⏳ Pyodide is still loading...";
    return;
  }

  const userCode = editor2.getValue();

  const testSuite = `
print("\\nRunning Hidden Tests for Lesson 2...")
passed_all_tests = True

test_cases = [
    ([[1, 2, 3], [4, 5, 6]], [2.0, 5.0]),
    ([[10, 20, 30], [5, 5, 5, 5]], [20.0, 5.0]),
    ([[100], [50, 50], [0, 0, 0]], [100.0, 50.0, 0.0]),
    ([[7, 8], [15, 5, 10]], [7.5, 10.0]),
    ([[23, 31, 19, 45]], [29.5])
]

for i, (input_data, expected) in enumerate(test_cases, 1):
    try:
        result = calculateAverages(input_data)
        if all(round(r, 5) == round(e, 5) for r, e in zip(result, expected)):
            print(f"✅ Test {i}: Passed")
        else:
            print(f"❌ Test {i}: Failed — Input: {input_data} | Expected: {expected} | Got: {result}")
            passed_all_tests = False
    except Exception as e:
        print(f"❌ Test {i}: Error on input {input_data} — {str(e)}")
        passed_all_tests = False

print("ALL_TESTS_PASSED" if passed_all_tests else "TESTS_FAILED")
`;

  const fullCode = `${userCode}\n\n${testSuite}`;

  try {
    await setupPyodideOutput();
    await pyodide.runPythonAsync(fullCode);
    const result = await getPyodideOutput();
    output.textContent = result || "(no output)";
    if (result.includes("ALL_TESTS_PASSED")) {
      alert("🎉 Congratulations! You completed Lesson 2!");
    }
  } catch (err) {
    output.textContent = "❌ Error:\n" + err;
  }
}


  </script>
  <div id="next-lesson" style="display: none; margin-top: 40px; padding: 20px; background-color: #2d2d2d; border: 1px solid #555; border-radius: 8px;">
  <h2>🎯 Next Lesson: Calculating multiple player's average at once</h2>
  <button onclick="startLesson2()" style="margin-top: 20px;">▶️ Start Lesson 2</button>
</div>

<div id="lesson-2" style="display: none; margin-top: 40px; padding: 20px; background-color: #2d2d2d; border: 1px solid #555; border-radius: 8px;">
  <h2>🏀 Advanced Basketball Statistics Challenge</h2>
  <p>
    Now you are analyzing multiple games!
    Each game has its own list of player scores.
  </p>
  <p>
    Write a function <code>calculateAverages(games: list)</code> that takes in a <strong>2D list</strong> of scores and returns a new list containing the average score for each game.
  </p>
  <p>Example:</p>
  <pre>
games = [
    [23, 31, 19, 45],
    [12, 15, 20],
    [50, 30]
]
# Expected Output:
[29.5, 15.666666666666666, 40.0]
  </pre>

  <textarea id="lesson2-editor">// Starter code will load here...</textarea>

  <br>
  <button onclick="runLesson2Code()">▶️ Run Code (Lesson 2)</button>
  <button onclick="runLesson2Tests()">🧪 Run Tests (Lesson 2)</button>

  <pre id="output-lesson2">(no output)</pre>
</div>


</body>
</html>

