import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

print("Searching for ProductResource in transcript.jsonl...")
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            data_str = json.dumps(data)
            if 'ProductResource' in data_str:
                step_idx = data.get('step_index')
                print(f"Match in step {step_idx}: type={data.get('type')}, source={data.get('source')}")
                # Print part of the content that matches
                idx = data_str.find('ProductResource')
                print(f"  Snippet: {data_str[max(0, idx-100):idx+200]}")
                print("-" * 50)
        except Exception as e:
            pass
