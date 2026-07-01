import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

steps_to_inspect = [1149, 1152, 1285, 1319]
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            step_idx = data.get('step_index')
            if step_idx in steps_to_inspect:
                print(f"=== Step {step_idx} ===")
                tool_calls = data.get('tool_calls', [])
                for tc in tool_calls:
                    print(f"Tool: {tc.get('name')}")
                    for k, v in tc.get('args', {}).items():
                        if k in ['TargetFile', 'ReplacementContent', 'ReplacementChunks', 'CodeContent']:
                            print(f"  {k}: {str(v)[:1000]}")
                print("=" * 50)
        except Exception as e:
            pass
