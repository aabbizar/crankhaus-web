import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if data.get('step_index') == 1317:
                print("=== Step 1317 ===")
                tool_calls = data.get('tool_calls', [])
                for tc in tool_calls:
                    print(f"Tool: {tc.get('name')}")
                    for k, v in tc.get('args', {}).items():
                        if k in ['TargetFile', 'CodeContent']:
                            print(f"  {k}: {str(v)[:1000]}")
                break
        except Exception as e:
            pass
