import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if data.get('step_index') == 14:
                content = data.get('content', '')
                with open("scratch/original_welcome_step_14.blade.php", 'w', encoding='utf-8') as out_f:
                    out_f.write(content)
                print("Saved step 14 content to scratch/original_welcome_step_14.blade.php")
                break
        except Exception as e:
            pass
