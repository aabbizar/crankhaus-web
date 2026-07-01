import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if 'ProductController' in str(data):
                step_index = data.get('step_index')
                print(f"Step {step_index}: source={data.get('source')}, type={data.get('type')}")
                # Print any tool call details
                for tc in data.get('tool_calls', []):
                    print(f"   Tool: {tc.get('name')} -> {tc.get('args')}")
                print("-" * 50)
        except Exception as e:
            pass
