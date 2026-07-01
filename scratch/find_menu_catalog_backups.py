import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            # Find VIEW_FILE steps that read menu-catalog.blade.php
            if data.get('type') == 'VIEW_FILE':
                content = data.get('content', '')
                if 'menu-catalog.blade.php' in content or 'livewire/menu-catalog.blade.php' in content:
                    print(f"VIEW_FILE Step {data.get('step_index')}: length={len(content)}")
                    # Save it to a file in scratch
                    out_path = f"scratch/menu_catalog_step_{data.get('step_index')}.blade.php"
                    with open(out_path, 'w', encoding='utf-8') as out_f:
                        out_f.write(content)
                    print(f"Saved to {out_path}")
            elif data.get('type') == 'CODE_ACTION':
                # Write file actions
                tool_calls = data.get('tool_calls', [])
                for call in tool_calls:
                    if 'write_to_file' in call.get('name', ''):
                        args = call.get('args', {})
                        if 'menu-catalog.blade.php' in args.get('TargetFile', ''):
                            print(f"CODE_ACTION (write_to_file) Step {data.get('step_index')}")
                            out_path = f"scratch/menu_catalog_write_step_{data.get('step_index')}.blade.php"
                            with open(out_path, 'w', encoding='utf-8') as out_f:
                                out_f.write(args.get('CodeContent', ''))
                            print(f"Saved to {out_path}")
        except Exception as e:
            pass
