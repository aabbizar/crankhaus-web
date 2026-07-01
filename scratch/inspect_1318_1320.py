import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            step_idx = data.get('step_index')
            if step_idx in [1318, 1320]:
                print(f"=== Step {step_idx} ===")
                # Print the content of this step
                print(data.get('content'))
                print("=" * 50)
        except Exception as e:
            pass
