import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

steps = []
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            steps.append(json.loads(line))
        except Exception as e:
            pass

print(f"Total steps: {len(steps)}")
# Print steps around the end of the previous session (1450 to 1470)
for step in steps[1430:1472]:
    print(f"Step {step.get('step_index')} (Type: {step.get('type')}, Source: {step.get('source')}):")
    calls = step.get('tool_calls', [])
    if calls:
        for call in calls:
            print(f"  Tool: {call.get('name')} -> {call.get('args', {}).get('TargetFile', '') or call.get('args', {}).get('AbsolutePath', '')}")
    content = step.get('content', '')
    if content:
        print(f"  Content snippet: {content[:300]}")
    print("-" * 50)
