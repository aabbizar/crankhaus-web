import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if data.get('step_index') == 1010:
                content = data.get('content', '')
                print(f"Step 1010 content length: {len(content)}")
                # Check if it contains the word "truncated"
                if "truncated" in content:
                    print("Warning: The log itself has '<truncated' text!")
                else:
                    print("Great! No '<truncated' text found in raw content.")
                with open("scratch/step_1010_full_view.blade.php", 'w', encoding='utf-8') as out_f:
                    out_f.write(content)
                break
        except Exception as e:
            pass
