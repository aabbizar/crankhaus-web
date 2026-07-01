import json

log_path = r"C:\Users\abiza\.gemini\antigravity-ide\brain\19f3aa68-d6f0-4d25-874b-d3161afdbeb7\.system_generated\logs\transcript.jsonl"

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            step_index = data.get('step_index')
            # Check tool_calls in MODEL steps
            tool_calls = data.get('tool_calls', [])
            for call in tool_calls:
                if call.get('name') == 'write_to_file':
                    args = call.get('args', {})
                    target = args.get('TargetFile', '')
                    if 'menu-catalog.blade.php' in target:
                        content = args.get('CodeContent', '')
                        print(f"Step {step_index} write_to_file: target={target}, length={len(content)}")
                        if len(content) > 10000:
                            # Dump it!
                            with open(f"scratch/full_menu_catalog_write_{step_index}.blade.php", 'w', encoding='utf-8') as out_f:
                                out_f.write(content)
                            print(f"Saved full write to scratch/full_menu_catalog_write_{step_index}.blade.php")
            
            # Check content of VIEW_FILE steps
            if data.get('type') == 'VIEW_FILE':
                content = data.get('content', '')
                if 'menu-catalog.blade.php' in content:
                    print(f"Step {step_index} VIEW_FILE: length={len(content)}")
                    if len(content) > 10000:
                        with open(f"scratch/full_menu_catalog_view_{step_index}.blade.php", 'w', encoding='utf-8') as out_f:
                            out_f.write(content)
                        print(f"Saved full view to scratch/full_menu_catalog_view_{step_index}.blade.php")
        except Exception as e:
            pass
