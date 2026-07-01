import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            step_index = data.get('step_index')
            if step_index in [403, 514, 722]:
                print(f"=== Step {step_index} ===")
                print(data.keys())
                # If there are keys, print some
                for k in ['type', 'status', 'source', 'content']:
                    if k in data:
                        print(f"  {k}: {str(data[k])[:200]}")
                print("=" * 50)
        except Exception as e:
            pass
