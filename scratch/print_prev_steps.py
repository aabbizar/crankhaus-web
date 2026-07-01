import json
import sys

sys.stdout.reconfigure(encoding='utf-8')

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

steps = []
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            steps.append(json.loads(line))
        except Exception as e:
            pass

print(f"Total steps: {len(steps)}")
# Let's inspect steps from 1250 to 1320 (around the end of previous session)
for step in steps[1250:1320]:
    step_idx = step.get('step_index')
    step_type = step.get('type')
    source = step.get('source')
    content = step.get('content', '')
    tool_calls = step.get('tool_calls', [])
    
    print(f"[{step_idx}] Type: {step_type}, Source: {source}")
    if tool_calls:
        for tc in tool_calls:
            print(f"   Tool: {tc.get('name')} args={list(tc.get('args', {}).keys())}")
            tf = tc.get('args', {}).get('TargetFile') or tc.get('args', {}).get('AbsolutePath')
            if tf:
                print(f"     Target: {tf}")
    if content and len(content) > 0:
        clean_content = content.replace('\n', ' ')[:150]
        print(f"   Content: {clean_content}...")
    print("-" * 50)
