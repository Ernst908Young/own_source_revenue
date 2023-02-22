function removeSpecialCharsTags(input) {
    if (input) {
        input = input.replace(/(<\?[a-z]*(\s[^>]*)?\?(>|$)|<!\[[a-z]*\[|\]\]>|<!DOCTYPE[^>]*?(>|$)|<!--[\s\S]*?(-->|$)|<[a-z?!\/]([a-z0-9_:.])*(\s[^>]*)?(>|$))/gi, '');
        input = input.replace(/[&\+()$~%.^":*?<>{}]/g,'');
        //input = input.replace(/[&/\#,+()$~%.":*?<>{}]/g,'');
        //input = input.replace(/[0-9]/g,'');
        return input;
    }
    return "";
}
