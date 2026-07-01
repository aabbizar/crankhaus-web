import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if 'ProductResource' in str(data):
                step_idx = data.get('step_index')
                print(f"=== Step {step_idx} ===")
                print(f"type: {data.get('type')}, source: {data.get('source')}")
                # Print tool calls
                for tc in data.get('tool_calls', []):
                    print(f"  Tool: {tc.get('name')}")
                    print(f"  Args: {list(tc.get('args', {}).keys())}")
                    tf = tc.get('args', {}).get('TargetFile') or tc.get('args', {}).get('AbsolutePath')
                    if tf:
                        print(f"  Target: {tf}")
                print("-" * 50)
        except Exception as e:
            pass
