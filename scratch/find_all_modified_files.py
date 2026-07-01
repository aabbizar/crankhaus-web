import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

modified = {}
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            step_index = data.get('step_index')
            tool_calls = data.get('tool_calls', [])
            for call in tool_calls:
                name = call.get('name')
                if name in ['write_to_file', 'replace_file_content', 'multi_replace_file_content']:
                    args = call.get('args', {})
                    target = args.get('TargetFile', '')
                    if target:
                        if target not in modified:
                            modified[target] = []
                        modified[target].append((step_index, name))
        except Exception as e:
            pass

print("Modified files history:")
for target, history in sorted(modified.items()):
    print(f"File: {target}")
    for step_idx, name in history:
        print(f"  Step {step_idx}: {name}")
    print("-" * 50)
