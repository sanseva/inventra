<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Home | </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App css -->
    <link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style type="text/css">
        .bg-skyblue {
            background-color: #87CEEB !important;
        }

        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
        }

        .suggestions div {
            padding: 10px;
            cursor: pointer;
        }

        .suggestions div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body data-menu-color="light" data-sidebar="default">

    <div id="app-layout">

        <!-- Topbar Start -->
        <?php echo view('includes/header');?>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <?php echo view('includes/left');?>
        <!-- Left Sidebar End -->

        <div class="content-page" style="padding-top:100px">
            <div id="editor" style="height: 200px;"></div>
            <div id="suggestions" class="suggestions"></div>
            <div id="sub-suggestions" class="suggestions"></div>
            <div id="content-display" class="content-display" style="margin-top: 20px;">
                <!-- Detailed content will be shown here -->
            </div>

        </div>

    </div>

    <!-- Vendor -->
    <script src="<?= base_url();?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
      const suggestionsList = {
    '.ty': [
        'Type 1',
        'Type 2',
        'Type 3'
    ],
    '.med': [
        'Medication 1',
        'Medication 2',
        'Medication 3'
    ]
};

// Second-level suggestions with detailed content
const subSuggestions = {
    'Type 1': 'This is a detailed description of Type 1. It covers all the necessary aspects including its background, uses, and applications.',
    'Type 2': 'Type 2 comes with its own set of unique characteristics and properties. Here, we will explain its key features and how it contrasts with other types.',
    'Type 3': 'The third type is known for its versatility and widespread use. In this section, we explore its different functionalities and the scenarios in which it is most effective.',
    'Medication 1': 'Medication 1 is used for treating specific conditions, and here we describe its various applications, dosages, and side effects.',
    'Medication 2': 'Medication 2 serves as a treatment for other conditions. It has its own unique properties and is often prescribed under certain circumstances.',
    'Medication 3': 'Medication 3 is a commonly used drug for specific treatments. This section covers its applications, safety profile, and dosage recommendations.'
};

// Sub-level suggestions for each first-level item (e.g., sub-types for Type 1, medications for Medication 1)
const subLevelSuggestions = {
    'Type 1': [
        'Sub-Type A: A more specific explanation of Sub-Type A, discussing its unique qualities and relevance.',
        'Sub-Type B: Here we explore Sub-Type B in depth, highlighting how it is utilized in various industries.',
        'Sub-Type C: This section delves into Sub-Type C, explaining why it is critical in certain scientific fields.'
    ],
    'Type 2': [
        'Sub-Type D: A deep dive into Sub-Type D, analyzing its practical applications and advantages over other types.',
        'Sub-Type E: This sub-type is relevant for specific niches. We explore how it is used in medical research and technology.',
        'Sub-Type F: Sub-Type F stands out due to its flexibility in usage. This section outlines its key benefits and challenges.'
    ],
    'Type 3': [
        'Sub-Type G: Sub-Type G is particularly useful in environments where efficiency is key. We explore its best-use cases.',
        'Sub-Type H: Discussing Sub-Type H, we look at how it compares to other types in terms of versatility and scalability.',
        'Sub-Type I: Sub-Type I has gained popularity in certain markets. Here, we explain its economic benefits and global applications.'
    ],
    'Medication 1': [
        'Dose 1: A detailed explanation of Dose 1, its uses, and how it interacts with the body.',
        'Dose 2: Medication 1 is also prescribed in this second dose, and this is how it affects different patients.',
        'Dose 3: This dose is used in certain medical conditions and has a specific effect on various patients.'
    ],
    'Medication 2': [
        'Dose A: Medication 2 is administered in this dose for specific conditions, which we discuss in detail.',
        'Dose B: This dosage is typically given in clinical settings and has its own profile of side effects.',
        'Dose C: Here we explain the medical application of this dosage and how it is tailored for patients.'
    ],
    'Medication 3': [
        'Dose X: This dose of Medication 3 is commonly used for a set of specific conditions.',
        'Dose Y: When given in this dose, the medication has a unique effect on the body.',
        'Dose Z: This dosage is used when treating more severe cases and requires careful monitoring.'
    ]
};

// Initialize Quill editor
const editor = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [['bold', 'italic'], [{ 'list': 'ordered'}, { 'list': 'bullet' }]]
    }
});

const suggestionsBox = document.getElementById('suggestions');
const subSuggestionsBox = document.getElementById('sub-suggestions');
let currentTrigger = '';
let currentSelection = ''; // Tracks the selected first-level suggestion

// Listen for input changes in the editor
editor.on('text-change', function(delta, oldDelta, source) {
    const cursorPosition = editor.getSelection().index;
    const currentText = editor.getText(0, cursorPosition);

    // Detect trigger and show first-level suggestions
    const trigger = currentText.slice(-3);  // Check last 3 characters typed
    if (suggestionsList[trigger] && trigger !== currentTrigger) {
        currentTrigger = trigger; // Update current trigger
        currentSelection = ''; // Reset second-level suggestion state
        const options = suggestionsList[trigger];

        suggestionsBox.innerHTML = '';  // Clear previous suggestions
        suggestionsBox.style.display = 'block';

        options.forEach(option => {
            const div = document.createElement('div');
            div.textContent = option;
            div.onclick = function() {
                // Insert the selected first-level suggestion into the editor
                const textBefore = currentText.slice(0, cursorPosition - 3);  // Remove the trigger
                editor.setText(textBefore + option + editor.getText(cursorPosition));  // Insert option
                suggestionsBox.style.display = 'none';  // Hide first-level suggestions
                currentSelection = option; // Track selected option for second-level suggestions
                displayContent(option); // Display content for the selected option
                showSubSuggestions(option); // Show sub-level suggestions for the selected option
            };
            suggestionsBox.appendChild(div);
        });

        // Position the suggestion box
        const bounds = editor.getBounds(cursorPosition);
        suggestionsBox.style.top = `${bounds.top + bounds.height}px`;
        suggestionsBox.style.left = `${bounds.left}px`;
    } else if (!suggestionsList[trigger]) {
        suggestionsBox.style.display = 'none'; // Hide if no valid trigger
        currentTrigger = '';
    }
});

// Display detailed content when a suggestion is selected
function displayContent(selected) {
    const contentDisplay = document.getElementById('content-display');
    contentDisplay.innerHTML = `<p>${subSuggestions[selected]}</p>`;  // Show the content related to Type or Medication
}

// Show second-level suggestions based on the first-level selection
function showSubSuggestions(selected) {
    const subOptions = subLevelSuggestions[selected] || [];
    subSuggestionsBox.innerHTML = ''; // Clear existing sub-suggestions
    subSuggestionsBox.style.display = 'block';

    subOptions.forEach(subOption => {
        const div = document.createElement('div');
        div.textContent = subOption;
        div.onclick = function() {
            // Insert the selected sub-level suggestion into the editor
            const cursorPosition = editor.getSelection().index;
            const currentText = editor.getText(0, cursorPosition);
            const textBefore = currentText.slice(0, cursorPosition - currentSelection.length); // Remove first-level selection
            editor.setText(textBefore + subOption + editor.getText(cursorPosition));  // Insert sub-option
            subSuggestionsBox.style.display = 'none'; // Hide sub-level suggestions
        };
        subSuggestionsBox.appendChild(div);
    });

    // Position the sub-suggestions box below the content
    const bounds = document.getElementById('content-display').getBoundingClientRect();
    subSuggestionsBox.style.top = `${bounds.bottom + window.scrollY}px`;
    subSuggestionsBox.style.left = `${bounds.left}px`;
}

// Hide suggestion boxes when clicking outside
document.addEventListener('click', function(e) {
    if (!editor.root.contains(e.target) && !suggestionsBox.contains(e.target) && !subSuggestionsBox.contains(e.target)) {
        suggestionsBox.style.display = 'none';
        subSuggestionsBox.style.display = 'none';
    }
});

    </script>

</body>

</html>
