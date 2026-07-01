import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            tool_calls = data.get('tool_calls', [])
            for call in tool_calls:
                name = call.get('name')
                if name in ['write_to_file', 'replace_file_content', 'multi_replace_file_content']:
                    args = call.get('args', {})
                    target = args.get('TargetFile', '')
                    if 'routes/web.php' in target or 'routes\\web.php' in target:
                        print(f"=== Step {data.get('step_index')}: {name} ===")
                        for k, v in args.items():
                            if k in ['ReplacementContent', 'CodeContent', 'ReplacementChunks']:
                                print(f"  {k}: {str(v)}")
                        print("-" * 50)
        except Exception as e:
            pass
